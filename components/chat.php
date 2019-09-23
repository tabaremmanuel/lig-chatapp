<script type="text/babel">
class Chat extends React.Component{
  render(){
    return(
      <div>
        <div className="container">
          <div className="message-list">
            <div className="message-container">
              <div className="message-text">
                Hi Ken,<br/>
                I just sent the document to you on mail.<br/>
                Plz check it!
              </div>
              <div className="message-sender">May</div>
            </div>
            <div className="message-container own-message">
              <div className="message-text">
                Thank you May!<br/>
                It was great.
              </div>
              <div className="message-sender">You</div>
            </div>
            <div className="message-container own-message">
              <div className="message-text">
                I just checked it.<br/>
                Thanks!
              </div>
              <div className="message-sender">You</div>
            </div>
            <div className="message-container">
              <div className="message-text">
                Hi guys, what's up?
              </div>
              <div className="message-sender">Mark</div>
            </div>
            <div className="message-container">
              <div className="message-text">
                Hi Mark, I stay Cebu now
              </div>
              <div className="message-sender">April</div>
            </div>
          </div>
        </div>
        <div className="type-box">
          <div className="container">
            <input type="text" placeholder="Start a new message" />
            <button className="btn">send</button>
          </div>
        </div>
      </div>
    )
  }
}
</script>
