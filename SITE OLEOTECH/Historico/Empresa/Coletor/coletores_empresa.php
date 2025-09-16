<?php
session_start();
include(__DIR__ . '/../../../Login/config.php');

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../../../Login/login.php');
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$tipo_usuario = $_SESSION['tipo_usuario'];

// Apenas empresas acessam esta página
if ($tipo_usuario !== 'empresa') {
    header('Location: ../../../Login/login.php');
    exit();
}

// CSRF token simples
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// ------------------------------
// ORDENAR
// ------------------------------
$ordenar = $_GET['ordenar'] ?? 'id'; // padrão por ID
$order_by = ($ordenar === 'nome') ? "nome ASC" : "id_coletor ASC";

// ------------------------------
// Tratamento de exclusão (POST)
// ------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $msg = ['success' => null, 'error' => null];

    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')) {
        $msg['error'] = 'Token inválido. Tente novamente.';
    } else {
        $id = intval($_POST['id_coletor'] ?? 0);
        if ($id > 0) {
            $stmt = $conexao->prepare("DELETE FROM tb_coletores WHERE id_coletor = ? AND idEmpresa = ?");
            $stmt->bind_param('ii', $id, $usuario_id);
            if ($stmt->execute()) {
                $msg['success'] = 'Coletor removido com sucesso.';
            } else {
                $msg['error'] = 'Erro ao remover coletor.';
            }
            $stmt->close();
        } else {
            $msg['error'] = 'ID inválido.';
        }
    }

    $_SESSION['flash'] = $msg;
    header('Location: ' . $_SERVER['PHP_SELF'] . (isset($_GET['q']) ? '?q=' . urlencode($_GET['q']) : ''));
    exit();
}

// ------------------------------
// Export CSV
// ------------------------------
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    $q = trim($_GET['q'] ?? '');
    $search_param = "%$q%";

    $sql = "SELECT id_coletor, nome, email, telefone, data_cadastro, status 
            FROM tb_coletores 
            WHERE idEmpresa = ?";
    if ($q !== '') {
        $sql .= " AND (nome LIKE ? OR email LIKE ? OR telefone LIKE ?)";
    }
    $sql .= " ORDER BY $order_by";

    $stmt = $conexao->prepare($sql);
    if ($q !== '') {
        $stmt->bind_param('isss', $usuario_id, $search_param, $search_param, $search_param);
    } else {
        $stmt->bind_param('i', $usuario_id);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=coletores_empresa.csv');

    $out = fopen('php://output', 'w');
    fputcsv($out, ['ID', 'Nome', 'Email', 'Telefone', 'Data de Cadastro', 'Status']);
    while ($row = $result->fetch_assoc()) {
        fputcsv($out, [
            $row['id_coletor'],
            $row['nome'],
            $row['email'],
            $row['telefone'],
            ($row['data_cadastro']) ? date('d/m/Y', strtotime($row['data_cadastro'])) : '—',
            $row['status'] ?? '—'
        ]);
    }
    fclose($out);
    exit();
}

// ------------------------------
// Busca / paginação
// ------------------------------
$q = trim($_GET['q'] ?? '');
$page = max(1, intval($_GET['page'] ?? 1));
$limit = 10;
$offset = ($page - 1) * $limit;
$search_param = "%$q%";

// Conta total
$count_sql = "SELECT COUNT(*) AS total FROM tb_coletores WHERE idEmpresa = ?";
if ($q !== '') {
    $count_sql .= " AND (nome LIKE ? OR email LIKE ? OR telefone LIKE ?)";
}

$stmt = $conexao->prepare($count_sql);
if ($q !== '') {
    $stmt->bind_param('isss', $usuario_id, $search_param, $search_param, $search_param);
} else {
    $stmt->bind_param('i', $usuario_id);
}
$stmt->execute();
$res_count = $stmt->get_result();
$total = $res_count->fetch_assoc()['total'] ?? 0;
$stmt->close();

$pages = max(1, ceil($total / $limit));

// Seleciona coletores
$select_sql = "SELECT id_coletor, nome, email, telefone, data_cadastro, status 
               FROM tb_coletores 
               WHERE idEmpresa = ?";
if ($q !== '') {
    $select_sql .= " AND (nome LIKE ? OR email LIKE ? OR telefone LIKE ?)";
}
$select_sql .= " ORDER BY $order_by LIMIT $limit OFFSET $offset";

$stmt = $conexao->prepare($select_sql);
if ($q !== '') {
    $stmt->bind_param('isss', $usuario_id, $search_param, $search_param, $search_param);
} else {
    $stmt->bind_param('i', $usuario_id);
}
$stmt->execute();
$res = $stmt->get_result();

// flash message
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

// ------------------------------
// Tratamento de edição
// ------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
    $id = intval($_POST['id_coletor'] ?? 0);
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');

    if ($id > 0 && $nome && $email && $telefone) {
        $stmt = $conexao->prepare("UPDATE tb_coletores SET nome = ?, email = ?, telefone = ? WHERE id_coletor = ? AND idEmpresa = ?");
        $stmt->bind_param('sssii', $nome, $email, $telefone, $id, $usuario_id);
        $stmt->execute();
        $stmt->close();

        $_SESSION['flash']['success'] = 'Coletor atualizado com sucesso.';
    } else {
        $_SESSION['flash']['error'] = 'Todos os campos são obrigatórios.';
    }

    header('Location: ' . $_SERVER['PHP_SELF'] . (isset($_GET['q']) ? '?q=' . urlencode($_GET['q']) : ''));
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Coletores - Empresa OLEOTECH</title>
    <link rel="stylesheet" href="../../Login/Login.css">
    <link class="iconSite" rel="icon" type="image/png" href="../../../img/gota__1_-removebg-preview.png">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 20px;
            background: #f5f5f5;
        }

        h2 {
            color: #1B63C5;
        }

        .top-actions {
            margin-bottom: 12px;
        }

        .botao {
            display: inline-block;
            margin-right: 8px;
            padding: 8px 12px;
            background: #1B63C5;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
        }

        .botao:hover {
            background: #0553a3;
        }

        .search-form {
            display: inline-block;
            margin-left: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #1B63C5;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .actions a {
            margin-right: 6px;
        }

        .paginator {
            margin-top: 12px;
        }

        .flash-success {
            background: #e6ffed;
            border: 1px solid #b7f0c9;
            padding: 8px;
            color: #0a7a3c;
            margin-bottom: 8px;
        }

        .flash-error {
            background: #ffecec;
            border: 1px solid #f5c2c2;
            padding: 8px;
            color: #a12b2b;
            margin-bottom: 8px;
        }

        .buscarNome {
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 250px;
        }

        .actions {
            white-space: nowrap;
        }

        #edit-form-<?php echo $row['id_coletor']; ?>input {
            margin: 2px;
            padding: 4px;
            width: 120px;
        }

        #edit-form-<?php echo $row['id_coletor']; ?>button {
            margin: 2px;
            padding: 4px 8px;
        }
    </style>
</head>

<script>
    function toggleEdit(id) {
        const form = document.getElementById('edit-form-' + id);
        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'inline-block';
        } else {
            form.style.display = 'none';
        }
    }
</script>

<body>

    <h2>Coletores cadastrados na sua empresa</h2>

    <?php if (!empty($flash['success'])): ?>
        <div class="flash-success"><?php echo htmlspecialchars($flash['success']); ?></div>
    <?php endif; ?>
    <?php if (!empty($flash['error'])): ?>
        <div class="flash-error"><?php echo htmlspecialchars($flash['error']); ?></div>
    <?php endif; ?>

    <div class="top-actions">
        <a href="../../../Main Page/index.html" class="botao">Sair</a>
        <a href="?export=csv<?php echo $q ? '&q=' . urlencode($q) : ''; ?>&ordenar=<?php echo htmlspecialchars($ordenar); ?>" class="botao">Exportar CSV</a>

        <form class="search-form" method="get" action="" style="display:inline-block;">
            <input class="buscarNome" type="text" name="q" placeholder="Pesquisar nome, email ou telefone" value="<?php echo htmlspecialchars($q); ?>">
            <input type="hidden" name="ordenar" value="<?php echo htmlspecialchars($ordenar); ?>">
            <button type="submit" class="botao">Buscar</button>
        </form>

        <!-- Botões de ordenação -->
        <div style="margin-top:10px;">
            <a href="?ordenar=id<?php echo $q ? '&q=' . urlencode($q) : ''; ?>" class="botao">Ver por ordem de chegada (ID)</a>
            <a href="?ordenar=nome<?php echo $q ? '&q=' . urlencode($q) : ''; ?>" class="botao">Ver por ordem alfabética</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Data cadastro</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($res && $res->num_rows > 0): ?>
                <?php while ($row = $res->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id_coletor']; ?></td>
                        <td><?php echo htmlspecialchars($row['nome']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['telefone']); ?></td>
                        <td><?php echo ($row['data_cadastro']) ? date('d/m/Y', strtotime($row['data_cadastro'])) : '—'; ?></td>
                        <td><?php echo htmlspecialchars($row['status'] ?? 'Ativo'); ?></td>
                        <td class="actions">
                            <button type="button" class="botao" onclick="toggleEdit(<?php echo $row['id_coletor']; ?>)">Editar</button>

                            <form method="post" action="" style="display:none;" id="edit-form-<?php echo $row['id_coletor']; ?>">
                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                <input type="hidden" name="id_coletor" value="<?php echo $row['id_coletor']; ?>">
                                <input type="text" name="nome" value="<?php echo htmlspecialchars($row['nome']); ?>" required>
                                <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
                                <input type="text" name="telefone" value="<?php echo htmlspecialchars($row['telefone']); ?>" required>
                                <button type="submit" name="action" value="edit" class="botao">Salvar</button>
                                <button type="button" class="botao" onclick="toggleEdit(<?php echo $row['id_coletor']; ?>)">Cancelar</button>
                            </form>

                            <form method="post" action="" style="display:inline-block;" onsubmit="return confirm('Tem certeza que deseja remover este coletor? Esta ação é permanente.');">
                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                <input type="hidden" name="id_coletor" value="<?php echo $row['id_coletor']; ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="botao">Remover</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Nenhum coletor encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="paginator">
        <?php if ($page > 1): ?>
            <a class="botao" href="?page=<?php echo $page - 1; ?><?php echo $q ? '&q=' . urlencode($q) : ''; ?>&ordenar=<?php echo htmlspecialchars($ordenar); ?>">« Anterior</a>
        <?php endif; ?>

        Página <?php echo $page; ?> de <?php echo $pages; ?>

        <?php if ($page < $pages): ?>
            <a class="botao" href="?page=<?php echo $page + 1; ?><?php echo $q ? '&q=' . urlencode($q) : ''; ?>&ordenar=<?php echo htmlspecialchars($ordenar); ?>">Próxima »</a>
        <?php endif; ?>
    </div>

</body>


</html>