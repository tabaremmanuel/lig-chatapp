<?php require_once './components/form.php'; ?>
<?php require_once './components/chat.php'; ?>
<script type="text/babel">
  const App = props => {

      let appUI = null,
      logout = null;

      if(props.logStatus == 0){
        appUI = (
          <div className="login">
            <LoginForm />
          </div>
        )
      }else{
        appUI = (
          <div className="chat-ui">
            <Chat />
          </div>
        )
        logout = <a className="btn" href="/php/logout.php">Log out</a>
      }

      return(
        <div className="app">
          <div className="app-header">
            <div className="container">
              <h1>Chat app</h1>
              {logout}
            </div>
          </div>
          {appUI}
        </div>
      )
  }
</script>
