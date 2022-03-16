// Function to convert bytes to human readable format
const bytesToSize = (bytes) => {
  var sizes = ["Bytes", "KB", "MB", "GB", "TB"];
  if (bytes == 0) return "0 Byte";
  var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
  return Math.round(bytes / Math.pow(1024, i), 2) + " " + sizes[i];
};

// Custom file input
const actualBtn = document.getElementById("actual-btn"); // Getting the actual button
const fileChosen = document.getElementById("file-chosen"); // Getting the file choosen div

// Set the file choosen div text to file name when the file is changed
actualBtn.addEventListener("change", function () {
  fileChosen.textContent =
    this.files[0].name.length > 33
      ? this.files[0].name.substr(0, 30) + "..."
      : this.files[0].name;

  // Fetching file extension and setting it to file type
  const fileExtension = this.files[0].name.split(".").pop().toUpperCase();
  $("#fileType").text(fileExtension);
});

// Setting ajaxForm to achive the process status of uplaoding
$("#form").ajaxForm({
  beforeSend: function () {
    $(".uploading-status").removeClass("hidden");
    $(".progress-bar").css({
      "--percent": "0%",
      "--primary-color": "#06f",
      "--color": "#000",
    });
    $(".progress-bar").text("0%");
    $("#sendButton").attr("disabled", true); // Disable the send button
    // If transfer is from link set the file type to file extension
    if ($("#link").val() != "") {
      $("#fileType").text($("#link").val().split(".").pop().toUpperCase());
    }
  },
  uploadProgress: function (event, position, total, percentComplete) {
    if ($("#link").val() == "") {
      // If the link is empty, then set the progress text
      $(".progress-bar").text(`${percentComplete}%`);
      // Setting other information
      $("#completedSize").text(bytesToSize(position));
      $("#totalSize").text(bytesToSize(total));
      $(".progress-bar").css("--percent", `${percentComplete}%`);
    } else {
      // If the link is not empty, then set the progress text to Uploading..
      $(".progress-bar").text("Uploading...");

      $("#completedSize").text("Unallocated");
      $("#totalSize").text("Unallocated");
      $(".progress-bar").css("--percent", `75%`);
    }

    // If the completed upload progress is upto 50%, then change the progress bar text color to white
    if (percentComplete > 50) {
      $(".progress-bar").css("--color", "#fff");
    }
  },
  complete: function (xhr) {
    $(".progress-bar").css({
      "--percent": "100%",
      "--primary-color": "#38b000",
      "--color": "#fff",
    });
    $("#sendButton").attr("disabled", false); // Enable the send button
    $(".progress-bar").text("Completed");
    // If the uploading is from link
    if ($("#link").val() != "") {
      // Set file and completed file size to dynamic
      $("#completedSize").text(bytesToSize(xhr.responseText));
      $("#totalSize").text(bytesToSize(xhr.responseText));
    }

    // Empty file input and link
    $("#actual-btn").val("");
    $("#file-chosen").text("No file chosen");
    $("#link").val("");
  },
});
