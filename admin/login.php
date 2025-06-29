<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../public/css/output.css" />
    <title>Zibnet Corp | Jasa Pasang Router di Bali</title>
    <link rel="icon" type="image/x-icon" href="./assets/image/logo/logo2.png">
  </head>
  <body class="bg-gradient-to-r from-indigo-400 via-blue-300 to-purple-300 h-screen flex items-center justify-center">
    <?php
    session_start();
    if (isset($_SESSION['admin_logged_in'])) {
      header("Location: dashboard.php");
      exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $username = $_POST['username'];
      $password = $_POST['password'];

      if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        header("Location: dashboard.php");
        exit;
      } else {
        $error = "Username atau Password salah!";
      }
    }
    ?>

    <div class="bg-white shadow-xl rounded-xl p-10 w-full max-w-md">
      <div class="text-center mb-8">
        <h2 class="text-2xl font-bold mb-1">Welcome Admin Zibnet!</h2>
      </div>

      <?php if (isset($error)): ?>
        <p class="text-red-500 mb-3 text-center text-sm"><?= $error ?></p>
      <?php endif; ?>

      <form method="POST" class="space-y-4">
        <div>
          <label class="text-sm text-gray-600">Email</label>
          <input type="text" name="username" placeholder="Enter your Email" required
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-biruMuda" />
        </div>
        <div>
          <label class="text-sm text-gray-600">Password</label>
          <div class="relative">
            <input type="password" name="password" placeholder="Enter Password" required
              class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-biruMuda" />
            <span class="absolute right-3 top-2.5 text-gray-400 cursor-pointer">
              <!-- icon bisa ditambahkan di sini -->
              &#128065;
            </span>
          </div>
        </div>
        <button type="submit"
          class="w-full bg-biruTua hover:bg-biruMuda text-white font-semibold py-2 rounded-lg transition duration-200">
          Masuk Dashboard
        </button>
      </form>
    </div>
  </body>
</html>
