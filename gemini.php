<?php
session_start();
include "config.php"; // Your database connection file


$email = $_SESSION['email']; // Assume email is stored in the session after login

// Query to get the username
$sql = "SELECT username FROM signin WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
} else {
    $username = 'Guest'; // Default username if none is found
}

$stmt->close();
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gemini AI</title>
    <!-- <link rel="stylesheet" href="gemini.css" /> -->
    <script
      src="https://kit.fontawesome.com/5274d0405c.js"
      crossorigin="anonymous"
    ></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
  </head>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins&display=swap");
    * {
      margin: 0px;
      padding: 0px;
      box-sizing: border-box;
      font-family: "Poppins";
    }

    body {
      background: white;
      height: 100vh;
    }

    i {
      font-size: 16px;
    }
    .container {
      height: 100%;
      display: flex;
    }

    .sideNavigation {
      background-color: #f0f4f9;
      width: 350px;
      padding: 1rem;
      transition: all 0.3s ease-in-out;
    }

    .sideNavigation .topBarAction {
      margin: 15px;
      cursor: pointer;
    }

    .sideNavigation .topBarAction i {
      font-size: 18px;
    }

    .sideNavigation .sideNavButton {
      margin-top: 50px;
      margin-bottom: 30px;
    }

    .sideNavigation .chatHistory {
      max-height: 250px;
      overflow-y: scroll;
    }

    .sideNavigation .chatHistory::-webkit-scrollbar {
      display: none;
    }

    .sideNavigation .chatHistory h5 {
      font-size: 0.875rem;
      font-weight: 500;
      line-height: 1.25rem;
      margin: 15px 5px;
    }

    ul {
      list-style-type: none;
    }

    .sideNavigation .chatHistory li {
      height: 40px;
      border-radius: 50px;
      display: flex;
      align-items: center;
      padding: 10px;
      cursor: pointer;
      font-size: 14px;
      display: inline-block;
      width: 225px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .sideNavigation .chatHistory i {
      padding-right: 10px;
    }

    .sideNavigation .chatHistory li:hover,
    .sideNavigation .actionList button:hover {
      background: #dde3ea;
    }

    .sideNavigation .sideNavButton button {
      height: 40px;
      width: 140px;
      border-radius: 50px;
      outline: none;
      border: none;
      background: #dde3ea;
      display: flex;
      align-items: center;
      justify-content: space-evenly;
      transition: 0.5s;
      cursor: pointer;
    }

    .sideNavigation .actionList {
      position: fixed;
      bottom: 15px;
      display: flex;
      flex-direction: column;
    }

    .sideNavigation .actionList button {
      margin: 1px;
      padding: 10px;
      text-align: left;
      border-radius: 50px;
      border: none;
      outline: none;
      width: 230px;
      cursor: pointer;
      background: transparent;
      transition: 0.3s;
    }

    .sideNavigation .actionList button .collapseText {
      padding: 0 10px;
    }

    .chatWindow {
      width: 100%;
      margin: 5rem;
      display: flex;
      justify-content: center;
    }

    .chatWindow .startContent {
      min-width: 830px;
      /* 830 */
    }

    .chatWindow .startContent h1 {
      font-size: 56px;
      line-height: 4rem;
      letter-spacing: normal;
      font-weight: 600;
      letter-spacing: -0.03rem;
      margin-top: 18px;
    }
    .chatWindow .startContent h1 .brandHello {
      background: linear-gradient(
        74deg,
        #4285f4 0,
        #9b72cb 9%,
        #d96570 20%,
        #d96570 24%,
        #9b72cb 35%,
        #4285f4 44%,
        #9b72cb 50%,
        #d96570 56%,
        #fff 75%,
        #fff 100%
      );
      background-size: 400% 100%;
      position: relative;
      display: inline-block;
      color: transparent;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .chatWindow .startContent h1 .brandQuestion {
      color: #c4c7c5;
      font-size: 55px;
    }

    .chatWindow .startContent ul {
      display: inline-flex;
      width: 830px;
      margin-top: 50px;
    }

    .chatWindow .startContent ul li {
      margin: 10px;
      padding: 10px;
      border-radius: 10px;
      background: #f0f4f9;
      cursor: pointer;
    }

    .chatWindow .startContent ul li:hover {
      background-color: #dde3ea;
    }

    .chatWindow .chatContent {
      width: 900px;
      max-height: auto;
      overflow-y: scroll;
    }

    .chatWindow .chatContent::-webkit-scrollbar {
      display: none;
    }

    .inputArea,
    .privacyPolicy {
      position: fixed;
      bottom: 30px;
      display: flex;
      background-color: #f0f4f9;
      border-radius: 50px;
      padding: 4px 8px;
    }

    .privacyPolicy {
      bottom: 5px;
      font-size: 12px;
      background: transparent;
    }

    .inputArea input {
      width: 800px;
      height: 50px;
      padding: 20px;
      outline: none;
      border: none;
      font-size: 16px;
      background: transparent;
    }

    .inputArea .iconGroup {
      position: relative;
      right: 5px;
    }

    .inputArea .iconGroup i {
      padding: 15px;
      font-size: 20px;
      cursor: pointer;
      transition: 0.5s;
    }

    .inputArea .iconGroup i:nth-child(3) {
      display: none;
    }

    .chatWindow .startContent .promptQuestions {
      display: flex;
      justify-content: space-between;
      flex-direction: column;
      height: 160px;
      width: 160px;
      font-size: 15px;
    }

    .chatWindow .startContent .promptQuestions p {
      margin: 1rem;
    }

    .chatWindow .startContent .promptQuestions .icon {
      text-align: end;
    }
    .chatWindow .startContent .promptQuestions i {
      background-color: white;
      padding: 10px;
      border-radius: 50px;
    }

    .sideNavigation.expandClose {
      width: 68px;
    }

    .sideNavigation.expandClose .sideNavButton button,
    .sideNavigation.expandClose .actionList button {
      width: 45px;
      text-align: center;
    }

    .sideNavigation.expandClose .collapseText,
    .sideNavigation.expandClose .chatHistory,
    .chatWindow .chatContent {
      display: none;
    }

    .chatWindow .chatContent .resultTitle {
      display: flex;
      align-items: center;
      margin-bottom: 2rem;
    }

    .chatWindow .chatContent .resultTitle img {
      margin-right: 10px;
      border-radius: 50%;
      height: 32px;
      width: 32px;
    }

    .chatWindow .chatContent .resultData img {
      margin-right: 10px;
      animation: spin 4s linear infinite;
      height: 32px;
      width: 32px;
    }

    .chatWindow .chatContent .resultResponse img {
      height: 32px;
      width: 32px;
      margin-right: 5px;
    }

    @keyframes spin {
      100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }

    .loader {
      width: 100%;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .loader .animatedBG {
      border-radius: 4px;
      border: none;
      animation: loader 3s infinite linear;
      background-color: #f6f7f8;
      background: linear-gradient(to right, #4285f4, white, #4285f4);
      height: 15px;
    }

    .animatedBG:nth-child(3) {
      width: 70%;
    }

    @keyframes loader {
      0% {
        background-position: -800px 0;
      }
      to {
        background-position: 800px 0;
      }
    }

    .chatWindow .chatContent .resultResponse,
    .chatWindow .chatContent .resultData {
      display: flex;
      align-items: start;
      margin-bottom: 1rem;
    }

    .chatWindow .chatContent .resultResponse p,
    .chatWindow .chatContent .resultData p {
      font-size: 17px;
      font-weight: 300;
      line-height: 2.2;
      margin-bottom: 2rem;
    }

    .location {
      width: 100%;
      height: 70px;
      padding: 10px;
      font-size: 13px;
      color: grey;
      margin-top: 10px;
      display: block;
      transition: all 1s ease-in-out;
    }

    .location i {
      margin-right: 8px;
    }

    #para {
      font-size: 10px;
      color: #245cb6;
      margin-left: 18px;
    }

    .active {
      display: none;
    }
  </style>
  <body>
    <div class="container">
      <div class="sideNavigation">
        <div class="topBarAction">
          <i class="fa-solid fa-bars"></i>
        </div>

        <div class="sideNavButton">
          <button>
            <i class="fa-solid fa-plus"></i
            ><span class="collapseText" onclick="newChat()">New Chat</span>
          </button>
        </div>

        <div class="chatHistory">
          <h5>Recent</h5>
          <ul></ul>
        </div>

        <div class="actionList">
          <button class="transparentButton">
            <i class="fa-regular fa-circle-question"></i
            ><span class="collapseText">Help</span>
          </button>
          <button class="transparentButton">
            <i class="fa-solid fa-clock-rotate-left"></i
            ><span class="collapseText">Activity</span>
          </button>
          <button class="transparentButton">
            <i class="fa-solid fa-gear"></i
            ><span class="collapseText">Settings</span>
          </button>
          <div class="location">
            <p>
              <i class="fa-solid fa-location-dot"></i
              ><span>Pune, Maharashtra, India</span>
            </p>
            <p id="para">From your IP address • Update location</p>
          </div>
        </div>
      </div>

      <div class="chatWindow">
        <div class="startContent">
          <h1>
            <span class="brandHello">Hello <?php echo $username?></span><br /><span
              class="brandQuestion"
              >How can I help you today?</span
            >
          </h1>
          <br />
          <ul></ul>
        </div>

        <div class="chatContent">
          <div class="results"></div>
        </div>
        <div class="inputArea" id="inputArea">
          <input type="text" placeholder="Enter a prompt here" />
          <div class="iconGroup">
            <i class="fa-solid fa-image"></i>
            <i class="fa-solid fa-microphone"></i>
            <i class="fa-solid fa-paper-plane"></i>
          </div>
        </div>
        <p class="privacyPolicy">
          Gemini may display inaccurate info, including the person, so
          double-check its responses. Your policy and Gemini Apps
        </p>
      </div>
    </div>

    <script>
      const sideNavigation = document.querySelector(".sideNavigation"),
        sideBarToggle = document.querySelector(".fa-bars"),
        startContentUI = document.querySelector(".startContent ul"),
        inputArea = document.querySelector(".inputArea input"),
        sendRequest = document.querySelector(".fa-paper-plane"),
        chatHistory = document.querySelector(".chatHistory ul"),
        startContent = document.querySelector(".startContent"),
        chatContent = document.querySelector(".chatContent"),
        results = document.querySelector(".results"),
        styleloc = document.querySelector(".actionList .location");

      promptQuestions = [
        {
          question: "Write a thank you note to my subscribers",
          icon: "fa-solid fa-wand-magic-sparkles",
        },
        {
          question: "Write a sample code to learn Javascript",
          icon: "fa-solid fa-code",
        },
        {
          question: "How to become a Full Stack Developer?",
          icon: "fa-solid fa-laptop-code",
        },
        {
          question: "How to become a Front-end Developer?",
          icon: "fa-solid fa-database",
        },
      ];

      window.addEventListener("load", () => {
        promptQuestions.forEach((data) => {
          let item = document.createElement("li");

          item.addEventListener("click", () => {
            getGeminiResponse(data.question, true);
          });
          item.innerHTML = `<div class="promptQuestions">
<p>${data.question}</p>
<div class="icon"><i class="${data.icon}"></i></div>
</div> `;

          startContentUI.append(item);
        });
      });

      sideBarToggle.addEventListener("click", () => {
        sideNavigation.classList.toggle("expandClose");
        styleloc.classList.toggle("active");
      });

      inputArea.addEventListener("keyup", (e) => {
        if (e.target.value.trim().length > 0) {
          sendRequest.style.display = "inline";
        } else {
          sendRequest.style.display = "none";
        }
      });

      sendRequest.addEventListener("click", () => {
        if (inputArea.value.trim().length > 0) {
          getGeminiResponse(inputArea.value.trim(), true);
        }
      });

      function getGeminiResponse(question, appendHistory) {
        if (appendHistory) {
          let historyli = document.createElement("li");
          historyli.addEventListener("click", () => {
            getGeminiResponse(question, false);
          });
          historyli.innerHTML = `<i class="fa-regular fa-message"></i>${question}`;
          chatHistory.append(historyli);
        }
        results.innerHTML = "";
        inputArea.value = "";
        startContent.style.display = "none";
        chatContent.style.display = "block";

        let resultTitle = `
<div class="resultTitle">
<img src="data:image/jpeg;base64,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" />
<p>${question}</p>
</div>`;

        let resultData = `
<div class="resultData">
<img src="data:image/png;base64,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" />
<div class="loader">
<div class="animatedBG"></div>
<div class="animatedBG"></div>
<div class="animatedBG"></div>
</div>
</div>
`;

        results.innerHTML += resultTitle;
        results.innerHTML += resultData;

        const AIURL = `https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=AIzaSyCIogbFBu7rIRm-rNFUbmF_dfPdhv8agKo`;
        fetch(AIURL, {
          method: "POST",
          body: JSON.stringify({
            contents: [{ parts: [{ text: question }] }],
          }),
        })
          .then((response) => response.json())
          .then((data) => {
            document.querySelector(".results .resultData").remove();
            let responseData = jsonEscape(
              data.candidates[0].content.parts[0].text
            );

            let responseArray = responseData.split("**");
            let newResponse = "";

            for (let i = 0; i < responseArray.length; i++) {
              if (i == 0 || i % 2 !== 1) {
                newResponse += responseArray[i];
              } else {
                newResponse +=
                  "<strong>" +
                  responseArray[i].split(" ").join("&nbsp") +
                  "</strong>";
              }
            }
            let newResponse2 = newResponse.split("*").join(" ");
            newResponse2 = newResponse2.replace(/^##\s*/, "");
            let textArea = document.createElement("textarea");
            textArea.innerHTML = newResponse2;

            results.innerHTML += `
      <div class="resultResponse">
    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAABI1BMVEX///8boeM5ktpCjtdnfMxShtJGjNY4k9pMidQ+kNhWhNFjfs1agtBgf85egM9DjdeRaMBressxltxxd8krmd52dchqest8csZweMqAcMUjneGEbsSHbcN+ccWKa8IAnOKJXLwfjNiNYr7R1u5ec8n19fsAld6Vodns7vhhbsd8sOPW6Pd9ZsGz2vTl3O+2ndRwveuLyO7b0Oo/rOauktBDfM/K4PSuteB1g89Za8dMYcPCyOh6itG0vuRWcMmEk9SVp9xxkdWgqt12mtjKz+uPmdZ9o9w/ftCrst+duuXIy+m70e1fndyio9lxq+GHhc1tZsOIesnBuOCbhczQ6PeGxu3k8vvFst2adcV/S7fTxeWp1vKcjs9Ys+iIn9lkm9sAgta5NACVAAAKz0lEQVR4nN2de1saRxTGYV1EQEBQ0GAiIrsrKCWJBjGJVdPWUGsajaYxSWPj9/8UndkL7GVue2N2533yf+b3nHfOOXNmFjOZOWs87/9w7rrgvYDYdcx7AbHrNe8FxC31De8VxK3emx7vJcSs7usu7yXErLev3/JeQswan4peEHeVXd5LiFknzRPeS4hZzWaT9xLiVU9pKmKXiy4gFLtc/AoIf+W9iFi125SbYidTuSnLQp8u1FNZlk9V3suIUV0FEAqdasaQUBY51Zw1IeEZ72XEKB1QLvFeRnwa6iYtKfu8FxKbxiahuBvxBLq0VCq9472Q2HQqG4TCVsSuYhIKWxHPTZOWSue8lxKTZDOEpXKZ91Li0dSk5bKgNv2tOSUsn/NeTCxSZiatCGnTrp1wJKJNwfFeLpkmrVTOeS8neqn2EFYqI/GK/lsXoXjXFyczk1aghOtNe84QVpZHog2Gp8XQIhQu1yi2cg8Bl5dHvJcUrd66TQoIxco1x7KHcDnHe1FRqus1KQiiSH3NiS3PTAmXBSoY3VN3JgUqFkfizNzOmrLXpMXi8u+8FxaVhqcoQpGCeNZEmhRIkCCCXYjIpDqhIOn0BBVCE1GIdPqHIuMJR1e8lxeBak1XDGd8OfCP9/LCa6wQTJrLTS55LzCsVNCvoTKpRZibpH2ccaE0sZk0BwmL73kvMZy6fRMQSahrcsR7kaF0XKOYFGiJ9yLD6E/FRogOYbqTTa9fc5i04iCcIaa3PT2uoU3qCOLSUm6R90KDaqzUPCatODOpTriUVp8O+zUvodekSxAxnT7dqLGZVBfvxQbRroIjLBa9hCms+39Bj9bwDY3dpNCnqTtk9PqmSZtMIQSIabvHON6oIUy6jCdcWuC9ZH+6WK3VyJnURbi4mK6tOO5vOHchbRsCwsWlFFXFbn+DYFJErdAJFx9Tc8roWYCETIoiXHxMSeFXV1c3bCYtMZoUqpqOA/8GANxA5RlkT2onrFYLvBfPomsrhEYMSwzl3iSsAn3gvXy6LhpTk1J70pw7hNWF6kfeADRd9J0hRJoUnWd0woXqHm8Esv4GgCiTok/3HpMuAHUSjagDOk0q+zJp0hEtQPw2LDIQFpKLeNFvrK5ityGt3FuAC4VCJ6Hp5ke/0bCFkHhdQQghIEwo4nWj0aCalFjuqxZgQeokry6qjcaUkGJSN6HVsc1CWJCkQj1hDVxv3UXYbCJO9ywmLRiEktRJVBvevbEB0kyKLIaOEOqEUidBh6lbA5Axk1LzTEHKS1I+n++85A1m6cfN+pSQFELUnBRtUoMwn5CU2vu0vt7wYVIc4YKXMC+tfeGNl8n8dbPuJKyhqqE/k0omYL6e7/zCG/AHBPQQojOpv20IIev1OucWbvjsyQwQuQ3LmJ4U27G5Cev5OseycXvzbB0VQsc29HFw8pjUELecOvw0MABx25BlmI/NpNKMsK61uITxfvDkmTeE+K6bYFJXx5Z3xbC+VtfmH0YQQABINalZ7ivUGBJMCgjX1rTWfDsc9cfgyRMrhJ5yTzcprSd1mhQSAsaHOfbitwMIiDcptdwTCT0mNQgB479z4jvYHGwagNRtyDwnpZnURGzNo/4P7wabm2hCJyDLkA3fdaMIW6017fBz/HxPN6eEQU1K70klVAgBYaulHcZZOQDf1tOnuBA6YuhvmO+sFXlXrZgCGtIe4orjwd024CMShpqTYsq9hxDGMY7S8f3r9tbWlgGIM6mnY/M9gqKa1FT7MOK82nu+s7NlAOoh3CQR2jJpoJ5UwuWZGWE222q3/4nu7Pj9bntnZctOSDJp0DkpphiueU0KCYHa7YdIisfw+c72yooBSDFpyGH+LIQ0k2YttdsvQu7I4fMVED47IC2EYYb5RJM6tmE2GwnkgYXHRBh2mE83KRJQZwR29b0nh/d321M8CzC4SZkzKb5lwxPqlNrhS+YqqR7c3+1s78zwPCHcDGRSpmE+AdCdaDyQ7ezhyyNKLHsH969Wtl10jhAymDTYMB9DSMwzKEot++IlwrK94cHt/auvOwg4bwjn0ZP62YYITBBNwPnZBAVk29++fcPBMYbQfyZlCqEPk3ooNSBIau694XdCDLGEhCkirqHB5Bm6SdkB3TFk2Icek+KPFdEM8wObFMIh96EbE+ZSbCYNaFK2PIMv99QY6rmUvS4O779O6yHKpOtxmJQpz2Do/NRDS6rV04Q1KeMwXwqaSaEzfwk6hzP6UnaTyqwDmmh6UoMvfPM9PRoii6HTpJEO8+kdW3g8Qwd3O3ZC5lE3A6E9k3omwZQQtsFBP7Ihce9+MGDJpLivRUOb1JtJQfgiHrp9/zQIYlKWWkEc5uuEnkwa+ZxGF5wFR3n2DdKT6ngxzdp0RnghE0G59z2Cspu01Y5tXgrVA4y+yj3zwYk4zJ8BtrSHuG9Lh9c3z9DlHvvomaknxd/HOOekcd9bQB18ojwwCXXjhB3mQ77svN6e3N4E6UnDzknb7XndHwKpFze0ENLKfRU9gsKbVHsx3/eYw+s+vtyHf2DiMamWnccGdGp8Qz1WhLhxcpmUw1sMoN51H0+InyIiTCpRbpy0LK9nUeO+7T4m5I0TwaR8AmhoSPzGST/7sj+/wHZsfJ9D7/aRT/V8mpT0/uKBK18Gfne/Qf5alHXUjT5WaNzfl4KEc6wEfyOE6UmnfK0EvBHOMPwWFNOxArEN+TvU0vjUNoIq+z5W4EzKM4e65fjN/PAjKBMwQd9bgM3oq9yjRlDebZiMLTiVehwuk7pLRb2VsO+egE4Ir6CIIUSZVMvyxkHpTKF+XIF8mY84OCUniTr1nxIwk7oJtcR+JnuuOE3K/pDNQai94A2C17nid06KeAWVZECAWA49RUw2INiLZYYQkt4IJXcPWvrd143T7PMRCzAZnxwS9a7ip9y7TXrIe/ksKoYwaYv34pmkhhjQJK9VQ2p/xECICmEnYc02Xt0R24DG1ZMm6fN0mi5HAUyanI/TWfR+mYnQnknzKagTduV8vRHS+23eS/ap3sinSdOTZSxdjeijbhthJ3W/Xwq24oTZpPm6lPhuFCUfU8R8nfdiA2l/xDqCyifrt2jYdTlhHEGlqxLa9Y4cwum3lGkrFDPtT6gHJynFHoW6nNgJMb/vkV6PQrHkmfR6FOpoQjVpmk4UKL2nmVRKWcPtkTrBm9T4tauUHOvxusT3pOkuhTMtEkfd6WzXnLqaEKaIaTxSePWTcLpP3k9cBtHRBJdnEvXTiGGkBxFZ7sUIIWxPMaf7NDekTv1Eh1ASJYRgJz4iCUXZhVA/kTfb4oQQBtG9DQULYSZTQIygRGhnZrpaBIQFxxRRjHZmJu+T4A7vJUWsSxuhcTJM5QyYoC+PrlF3+u4paPpQdZhUoGpv6arqKIai5RkgteMk5L2eGLRXtW1D4fIM1FHHHkKh+hlLVfsUkfdiYtFeVWyTmjYV2aSg/RbcpMCmC1a5F9Okuk3FNmlGfbSOFam/q8DpQ0HUntTSZccIoQC3MRjtm4TCjEm9MkfdvJcRoz7qxTDtt74kgY0o9DaEFVG4OalLagdeqQlbDaHqkmiTYLf2BG5KDf3bkTpz/KUgDgKpRuhEk8l86Qg4CnZK7I4G6oPABwtDe8n9c8YR6VLong3qiv+fbIxZR4IXC3iPKHixyKiPvFcQu0S8VnMqHV9rh5HIIwxDcy+H/wNdgsV4z0smaAAAAABJRU5ErkJggg==" />
    <p id="typeEffect"></p>  
    </div>
      `;
            let newResponseData = newResponse2.split(" ");
            for (let j = 0; j < newResponseData.length; j++) {
              timeOut(j, newResponseData[j] + " ");
            }
          });
      }

      const timeOut = (index, nextWord) => {
        setTimeout(function () {
          document.getElementById("typeEffect").innerHTML += nextWord;
        }, 75 * index);
      };

      function newChat() {
        startContent.style.display = "block";
        chatContent.style.display = "none";
      }

      function jsonEscape(str) {
        return str
          .replace(new RegExp("\r?\n\n", "g"), "<br>")
          .replace(new RegExp("\r?\n", "g"), "<br>");
      }
    </script>
  </body>
</html>
