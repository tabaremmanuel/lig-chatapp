<?php require_once "./php/process.php"; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>LIG Chat App</title>
    <link rel="stylesheet" href="./css/master.min.css">
    <script type="application/javascript" src="https://unpkg.com/react@16.0.0/umd/react.production.min.js"></script>
    <script type="application/javascript" src="https://unpkg.com/react-dom@16.0.0/umd/react-dom.production.min.js"></script>
    <script type="application/javascript" src="https://unpkg.com/babel-standalone@6.26.0/babel.js"></script>
    <script type="application/javascript" src="https://unpkg.com/axios/dist/axios.min.js"></script>
  </head>
  <body>
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root"></div>

    <?php require_once('./containers/app.php'); ?>
    <script type="text/babel">
      const rootElement = document.getElementById('root')
      const loggedIn = <?php echo $logged_in; ?>
      // Use the ReactDOM.render to show your component on the browser
      ReactDOM.render(<App logStatus={loggedIn} />,rootElement)
    </script>
  </body>
</html>
