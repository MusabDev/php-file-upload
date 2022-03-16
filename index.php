<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Remote file uploader</title>

    <!-- Link to CSS file -->
    <link rel="stylesheet" href="./assets/css/style.css" />

    <!-- Link to jQuery -->
    <script src="./assets/js/jquery-3.6.0.min.js" defer></script>
    <!-- Link to jQuery froms -->
    <script src="./assets/js/jquery.form.min.js" defer></script>
    <!-- Link to JS file -->
    <script src="./assets/js/script.js" defer></script>
  </head>
  <body>
    <!-- Navigation bar -->
    <nav>
      <div class="container">
        <div class="nav-wrapper">
          <div class="nav-brand">
            <a href="index.html">FileX</a>
          </div>
          <ul>
            <li>
              <a href="index.html">Home</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Main content with form -->
    <main>
      <div class="container">
        <div class="form-wrapper">
          <form
            action="send.php"
            method="post"
            enctype="multipart/form-data"
            id="form"
          >
            <h1 class="form-title">File Transfer</h1>
            <div class="file-input">
              <!-- actual upload which is hidden -->
              <input type="file" name="file" id="actual-btn" hidden />

              <!-- our custom upload button -->
              <label class="custom-file" for="actual-btn">Choose File</label>

              <!-- name of file chosen -->
              <span id="file-chosen">No file chosen</span>
            </div>
            <div class="or">
              <span>OR</span>
            </div>
            <div class="url-input">
              <input
                type="url"
                name="link"
                id="link"
                placeholder="Paste Download Link"
              />
            </div>
            <button class="btn" name="send" id="sendButton">Send File</button>
          </form>

          <!-- Uploading status -->
          <div class="uploading-status hidden">
            <div class="progress-bar"></div>
            <ul>
              <li>
                <strong>Completed:</strong>
                <span id="completedSize"></span>
              </li>
              <li>
                <strong>Total Size:</strong>
                <span id="totalSize"></span>
              </li>
              <li>
                <strong>File Type:</strong>
                <span id="fileType"></span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </main>

    <!-- Footer -->
    <footer>
      <div class="container">
        <label for="message">Message:</label>
        <textarea
          name="message"
          id="message"
          style="width: 100%; height: 200px; margin-top: 0.6rem"
        ></textarea>
      </div>
    </footer>
  </body>
</html>
