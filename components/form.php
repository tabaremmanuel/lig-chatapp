<script type="text/babel">
  class LoginForm extends React.Component{

    state = {
      username_err: '<?php echo $username_err; ?>',
      password_err: '<?php echo $password_err; ?>',
      username: '<?php echo $username; ?>',
      password: '<?php echo $password; ?>'
    }

    usernameHandler = event => {
      this.setState({
        username : event.target.value
      });
    }
    passwordHandler = event => {
      this.setState({
        password : event.target.value
      });
    }

    render(){
      return (
        <div className="container">
          <form action="/" method="post">
            {this.state.username_err}
            <input
              name="username"
              onChange={this.usernameHandler.bind(event) }
              type="text"
              value={this.state.username}
              placeholder="User name"
              autocomplete="username"  />
            {this.state.password_err}
            <input
              name="password"
              onChange={this.passwordHandler.bind(event)}
              type="password"
              value={this.state.password}
              placeholder="password"
              autocomplete="current-password" />
            <input type="submit" name="" value="Sign up / Log in" />
            <p>
              By signing up, you agree to the Terms of Service and Privacy Policy, including Cookie Use. Others will be able to find you by searching for your email address or phone number when provided.
            </p>
          </form>
        </div>
      )
    }
  }  
</script>
