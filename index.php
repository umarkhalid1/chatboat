<?php
session_start();

if (!isset($_SESSION['chat_history'])) {
    $_SESSION['chat_history'] = [];
}
if (isset($_SESSION['user'])) {
    include 'db.php';
    global $con;
    $user = $_SESSION['user'];
    $query = "SELECT * FROM `admin` WHERE `username`= '$user'";
    $run = mysqli_query($con, $query);
    if ($row = mysqli_fetch_array($run)) {
        $img = $row['image'];
        $name = $row['username'];
    }
    if (isset($_POST['userInput'])) {
      $userInput = strtolower($_POST['userInput']);
      $botResponses = [
        'hi' => 'Hello!',
        'hello' => 'Hello!',
        'Assalam o Alikum' => 'Walikum Assalam!',
        'assalamoalikum' => 'Walikum Assalam!',
        'how are you' => "I'm doing well, thank you! How about you?",
        'How are you' => "I'm doing well, thank you! How about you?",
        'tell me something about you' => 'Certainly! I am a chatbot. I am here for you to chat with. I am built using HTML, CSS, JavaScript, and PHP.',
        'Tell me something about you' => 'Certainly! I am a chatbot. I am here for you to chat with. I am built using HTML, CSS, JavaScript, and PHP.',
        'who created you' => 'I was created by Muhammad Umar.',
        'i am umar' => 'Nice to meet you, Umar!',
        'nice to meet you' => "Thank you! It's a pleasure to meet you.",
        'what is your name' => 'My name is CodeWhisper. May I ask for your name as well?',
        'oky thanks goodbye' => 'Goodbye! If you have any more questions in the future, feel free to ask.',

      ];
      $response = $botResponses[$userInput] ?? "I'm not sure what you mean.";

      date_default_timezone_set('Asia/Karachi');
      $currentTime = date("H:i");

      $_SESSION['chat_history'][] = ['user' => $userInput, 'bot' => $response, 'time' => $currentTime];
      header("Location: " . $_SERVER['REQUEST_URI']);
      exit();
    }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="images/logo.png" rel="icon">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>CodeWhisper</title>
</head>
<body>
  <section class="msger">
    <header class="msger-header">
      <div class="msger-header-title">
        <p>Welcome to CodeWhisper</p>
        <!-- <a href="logout.php">logout</a> -->
      </div>
    </header>
    <main class="msger-chat">
      <?php
        foreach ($_SESSION['chat_history'] as $message) {
      ?>
      <div class="msg left-msg">
        <div class="msg-img" style="background-image: url(images/profile.jpg)"></div>
        <div class="msg-bubble">
          <div class="msg-info">
            <div class="msg-info-name"><?php echo $name ;?></div>
            <div class="msg-info-time"><?php echo isset($message['time']) ? $message['time'] : ''; ?></div>
          </div>

          <div class="msg-text">
            <?php echo '<div class="message user-message"><span>' . htmlspecialchars($message['user']) . '</span></div>'; ?>
          </div>
        </div>
      </div>
      <div class="msg right-msg">
        <div class="msg-img" style="background-image: url(images/robot.png)"></div>
        <div class="msg-bubble">
          <div class="msg-info">
            <div class="msg-info-name">BOT</div>
            <div class="msg-info-time"><?php echo isset($message['time']) ? $message['time'] : ''; ?></div>
          </div>
          <div class="msg-text">
            <?php echo '<div class="message bot-message"><span>' . htmlspecialchars($message['bot']) . '</span></div>'; ?>
          </div>
        </div>
      </div>
      <?php  } ?>
    </main>
    <form id="chat-form" method="post" class="msger-inputarea" onsubmit="return validateForm()">
      <input type="text" class="msger-input" id="user-input" name="userInput" placeholder="Type a message...">
      <span class="validation-message" id="validation-message"></span>
      <button type="submit" class="msger-send-btn" id="send-button">Send</button>
    </form>
    <script>
      function validateForm() {
        var userInput = document.getElementById('user-input').value.trim();
        var validationMessage = document.getElementById('validation-message');
        if (userInput === "") {
          validationMessage.textContent = "Input must not be empty.";
          return false;
        }
        validationMessage.textContent = "";
        return true;
      }
    </script>
  </section>
</body>
</html>
<?php 
}else {
  header('Location:login.php');
} 
?>