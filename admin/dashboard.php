<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
  header("Location: login.php");
  exit;
}

include '../koneksi.php';

$nama = '';
$konten = '';
$id_edit = '';
$isEdit = false;

if (isset($_GET['edit'])) {
  $id_edit = intval($_GET['edit']);
  $isEdit = true;
  $result = $koneksi->query("SELECT * FROM testimoni WHERE id = $id_edit");
  if ($result && $result->num_rows > 0) {
    $data = $result->fetch_assoc();
    $nama = $data['nama'] ?? '';
    $konten = $data['konten'] ?? '';
  } else {
    $isEdit = false;
    $id_edit = '';
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $koneksi->real_escape_string($_POST['nama'] ?? '');
  $konten = $koneksi->real_escape_string($_POST['konten'] ?? '');
  $id_post = $_POST['id_edit'] ?? '';
  if (!empty($id_post)) {
    $id_post = intval($id_post);
    $koneksi->query("UPDATE testimoni SET nama='$nama', konten='$konten' WHERE id=$id_post");
  } else {
    $koneksi->query("INSERT INTO testimoni (nama, konten) VALUES ('$nama', '$konten')");
  }
  header("Location: dashboard.php");
  exit;
}

if (isset($_GET['hapus'])) {
  $id = intval($_GET['hapus']);
  $koneksi->query("DELETE FROM testimoni WHERE id=$id");
  header("Location: dashboard.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../public/css/output.css" />
  <title>Admin Dashboard</title>
  <link rel="icon" href="./assets/image/logo/logo2.png" type="image/x-icon">
</head>
<body class="bg-gray-100 min-h-screen flex">
  <!-- Sidebar -->
  <aside class="w-64 bg-gray-100 text-white p-6 space-y-6 border-r-[1px] border-stone-300">
    <h2 class="text-stone-950 text-2xl font-bold">Zibnet Admin</h2>
    <nav class="space-y-3">
      <a href="#" class="block py-2 px-3 rounded bg-biruTua text-white font-semibold hover:bg-biruMuda">Dashboard</a>
    </nav>
    <a href="logout.php" class="block mt-10 bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700">Logout</a>
  </aside>

  <!-- Main content -->
  <main class="flex-1 p-10">
    <h1 class="text-3xl font-bold text-stone-950 mb-6">Dashboard Admin</h1>

    <div class="bg-white p-6 rounded shadow-md">
      <h2 class="text-xl font-semibold mb-4">Daftar Testimoni</h2>
      <table class="w-full table-fixed border border-stone-950">
        <thead>
          <tr class="bg-gray-200 text-left">
            <th class="p-2 border text-left max-w-[30px]">#</th>
            <th class="p-2 border text-left max-w-[180px]">Nama</th>
            <th class="p-2 border text-left max-w-[400px]">Testimoni</th>
            <th class="p-2 border text-left max-w-[160px]">Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $result = $koneksi->query("SELECT * FROM testimoni ORDER BY id DESC");
        $no = 1;
        while ($row = $result->fetch_assoc()):
          if ($isEdit && $id_edit == $row['id']):
        ?>
        <tr class="bg-yellow-100">
          <form method="POST">
            <td class="p-2 border"><?= $no++ ?></td>
            <td class="p-2 border">
              <input type="text" name="nama" value="<?= htmlspecialchars($nama) ?>" class="w-full border p-1 rounded" required>
            </td>
            <td class="p-2 border">
              <textarea name="konten" class="w-full border p-1 rounded" required><?= htmlspecialchars($konten) ?></textarea>
            </td>
            <td class="p-2 border">
              <input type="hidden" name="id_edit" value="<?= $id_edit ?>">
              <button type="submit" class="bg-green-500 px-3 py-1 text-white rounded">Simpan</button>
              <a href="dashboard.php" class="text-sm text-red-600 ml-2">Batal</a>
            </td>
          </form>
        </tr>
        <?php else: ?>
        <tr>
          <td class="p-2 border"><?= $no++ ?></td>
          <td class="p-2 border"><?= htmlspecialchars($row['nama'] ?? '') ?></td>
          <td class="p-2 border"><?= htmlspecialchars($row['konten'] ?? '') ?></td>
          <td class="p-2 border space-x-2">
            <a href="?edit=<?= $row['id'] ?>" class="bg-yellow-400 px-3 py-1 rounded text-white">Edit</a>
            <a href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')" class="bg-red-500 px-3 py-1 rounded text-white">Hapus</a>
          </td>
        </tr>
        <?php endif; endwhile; ?>

        <!-- Form Tambah Baru -->
        <tr class="bg-gray-100">
          <form method="POST">
            <td class="p-2 border text-gray-600 font-medium">+</td>
            <td class="p-2 border">
              <input type="text" name="nama" placeholder="Nama baru" class="w-full border p-1 rounded" required>
            </td>
            <td class="p-2 border">
              <textarea name="konten" placeholder="Isi testimoni..." class="w-full border p-1 rounded" required></textarea>
            </td>
            <td class="p-2 border">
              <button type="submit" class="bg-blue-600 px-3 py-1 rounded text-white">Tambah</button>
            </td>
          </form>
        </tr>

        </tbody>
      </table>
    </div>
  </main>
</body>
</html>
