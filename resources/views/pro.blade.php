<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Garage Boutique</title>
  <link rel="stylesheet" href="style.css">
  <link rel="website icon" type="ico" href="favicon.ico">
  <script src="script.js"></script>
</head>
<body class="nice mb-4">
    <header>
      <h1>Bienvenue sur Garage Boutique</h1>
      <nav>
          <a href="#">Accueil</a>
          <a href="#">Produits</a>
          <a href="#">Panier</a>
      </nav>
  </header>
  <main>
      <section id="products">
          <h2>Nos Produits</h2>
          <?php include 'products.php'; ?>
          <?php foreach ($products as $product): ?>
              <div class="product" data-id="<?= $product['id'] ?>">
                  <h3><?= $product['name'] ?></h3>
                  <p>Prix: <?= $product['price'] ?>€</p>
                  <form action="cart.php" method="post">
                      <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                      <input type="hidden" name="product_name" value="<?= $product['name'] ?>">
                      <input type="hidden" name="product_price" value="<?= $product['price'] ?>">
                      <button type="submit" class="add-to-cart">Ajouter au panier</button>
                  </form>
              </div>
          <?php endforeach; ?>
      </section>
      <section id="cart">
          <h2>Votre Panier</h2>
          <ul id="cart-items">
              <?php
              session_start();
              $total = 0;
              foreach ($_SESSION['cart'] as $item):
                  $total += $item['price'] * $item['quantity'];
              ?>
                  <li><?= $item['name'] ?> - <?= $item['quantity'] ?> x <?= $item['price'] ?>€</li>
              <?php endforeach; ?>
          </ul>
          <p>Total: <span id="total-price"><?= $total ?></span>€</p>
      </section>
  </main>
</body>
</html>
