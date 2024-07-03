<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gemini AI</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/locomotive-scroll@3.5.4/dist/locomotive-scroll.css" />
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" href="geminilogo.png" type="image/icon type" />
</head>
<style>
  body::-webkit-scrollbar {
    width: 0.8em;

  }

  body::-webkit-scrollbar-track {
    box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
    background-color: black;
  }

  body::-webkit-scrollbar-thumb {
    background-color: #262626;

    outline: 1px solid slategrey;
    border-radius: 50px;
  }

  #login {
    display: none;
  }


  #preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #111111;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    flex-direction: column;
    color: white;
    font-family: poppins;

  }

  #preloader img {
    width: auto;
    height: 270px;
    object-fit: cover;
  }

  .main {
    display: none;

  }

  @media (max-width: 600px) {
    #login {
      display: block;
    }
  }
</style>

<body>
  <div id="preloader">
    <img src="preloader.gif" alt="">

  </div>

  <div class="main">
    <div class="page1">
      <div class="navbar">
        <div class="logo">
          <img src="geminilogo.png" />
          <p>Gemini</p>
        </div>
        <div class="menu-toggle"><i class="fas fa-bars"></i></div>
        <div class="nav-links">
          <ul>
            <li><a>Home</a></li>
            <li><a>About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a>Discover</a></li>
            <button onclick="window.location.href='signup.php'" id="login">Login</button>
          </ul>
        </div>
        <button onclick="window.location.href='signup.php'">Login</button>
      </div>
      <div class="tag">
        <p>Home > <span>Gemini AI</span></p>
      </div>
      <div class="videofootage">
        <video src="floatingspace1.mp4" autoplay loop muted></video>
        <div class="textupper">
          <h2>Welcome to the<br /><span>Gemini</span> era!</h2>
          <p>
            Experience the magic of AI-powered text generation with Gemini
            AI.<br />Effortlessly turn your concepts into polished, engaging
            text and say goodbye to writer's block.
          </p>
          <button id="Btn1" onclick="window.location.href='signin.php'">
            Chat with Gemini
            <span class="arrow">
              <i class="fa-solid fa-arrow-right"></i></span>
          </button>
        </div>
      </div>
    </div>

    <!-- Second page  -->
    <div class="page2">
      <div class="circle"></div>

      <div class="grid-container">
        <div class="cube">
          <img src="rotate.gif" alt="" />
        </div>
        <div class="heading1">
          <h2>Introducing Gemini AI Text Generator Online</h2>
          <p>
            Need help, information, or just someone to chat with? Our chatbot
            is here for you 24/7! Get instant support and enjoy seamless
            interactions that make your digital experience smoother and more
            enjoyable. Discover how our AI chatbot can assist you at any
            time<br /><br />
            Discover the magic of words with our AI Text Generator. Using
            advanced technology, it quickly and effectively creates polished
            content. Whether you're writing articles or social media posts,
            our tool is always available to help you express your ideas
            smoothly and effortlessly
          </p>
          <button class="Btn" onclick="window.location.href='signin.php'">
            Chat with Gemini
            <span class="arrow">
              <i class="fa-solid fa-arrow-right"></i></span>
          </button>
        </div>
      </div>
    </div>
    <div class="page3">
      <div class="heading2">
        <h2>
          Instantly Generate Engaging Content<br />for Any Platform
          Effortlessly!
        </h2>
        <p>
          The Gemini AI is completely free to use and can help you write,
          optimize,<br />and expand any content in an instant.
        </p>
      </div>
      <div class="grid1">
        <div class="title">
          <h3>Create Plagiarism-Free Content<br />in One Click</h3>
          <p>
            Need an engaging blog or a catchy ad? Our AI writer will
            instantly<br />create engaging copy you can use for marketing,
            sales, and any other purposes.
          </p>
        </div>
        <div class="image1">
          <img src="image1.svg" alt="" />
        </div>
      </div>
    </div>

    <div class="page4">
      <div class="grid2">
        <div class="image2">
          <img src="image2.svg" alt="" />
        </div>
        <div class="title1">
          <h3>Generate Content for Various Platforms and Formats</h3>
          <p>
            Looking to write copy for your website, social media, newsletters,
            and more? Our AI typer tool is up for any content creation
            challenge.
          </p>
        </div>
      </div>
    </div>

    <div class="page5">
      <img src="diamond.svg" alt="" id="diamond" />
      <div class="heading3">
        <h3>Why to choose <span>Gemini</span> ?</h3>
      </div>
      <div class="cards">
        <div class="card">
          <div class="card-border-top"></div>
          <div class="img"><img src="card1.svg" alt="" /></div>
          <span> Quality Content</span>
          <p class="job">
            Create engaging, original content across multiple formats
          </p>
        </div>

        <div class="card">
          <div class="card-border-top"></div>
          <div class="img"><img src="card2.svg" alt="" /></div>
          <span>100% Free</span>
          <p class="job">Use the tool as much as you want without payments</p>
        </div>

        <div class="card">
          <div class="card-border-top"></div>
          <div class="img"><img src="card3.svg" alt="" /></div>
          <span>AI Chatbot</span>
          <p class="job">
            Use the convenient AI chat to create and edit your content at the
            speed of light
          </p>
        </div>
      </div>
    </div>

    <div class="page6">
      <div class="container">
        <div class="accordion__wrapper">
          <h1 class="accordion__title">Frequently Asked Questions</h1>

          <!-- Accordion 1  -->
          <div class="accordion">
            <div class="accordion__header">
              <h2 class="accordion__question">How does the GeminiAI work?</h2>
              <span class="accordion__icon">
                <i id="accordion-icon" class="fa-solid fa-plus"></i>
              </span>
            </div>
            <div class="accordion__content">
              <p class="accordion__answer">
                The AI Text Generator is a free tool developed by Vikrant. It
                uses powerful AI and language models to produce original,
                plagiarism-free content.
              </p>
            </div>
          </div>

          <!-- Accordion 2  -->
          <div class="accordion">
            <div class="accordion__header">
              <h2 class="accordion__question">
                Why should you use the GeminiAI?
              </h2>
              <span class="accordion__icon">
                <i id="accordion-icon" class="fa-solid fa-plus"></i>
              </span>
            </div>
            <div class="accordion__content">
              <p class="accordion__answer">
                Our AI writer will help you save time and create high-quality,
                original copy for any marketing and sales purposes. It’s a
                great way to optimize your resources and attract more clients
              </p>
            </div>
          </div>

          <!-- Accordion 3 -->
          <div class="accordion">
            <div class="accordion__header">
              <h2 class="accordion__question">
                How much does this AI word generator cost?
              </h2>
              <span class="accordion__icon">
                <i id="accordion-icon" class="fa-solid fa-plus"></i>
              </span>
            </div>
            <div class="accordion__content">
              <p class="accordion__answer">
                The AI Text Generator is completely free to use. For extra
                features such as long-form articles, SEO data, and readability
                optimization, try ContentShake AI for free.
              </p>
            </div>
          </div>

          <!-- Accordion 4 -->
          <div class="accordion">
            <div class="accordion__header">
              <h2 class="accordion__question">
                What text can you generate with this tool?
              </h2>
              <span class="accordion__icon">
                <i id="accordion-icon" class="fa-solid fa-plus"></i>
              </span>
            </div>
            <div class="accordion__content">
              <p class="accordion__answer">
                Our AI writer can help you with multiple types of content—from
                articles and paragraphs to ads, emails, and social media posts
              </p>
            </div>
          </div>

          <!-- Accordion 5 -->
          <div class="accordion">
            <div class="accordion__header">
              <h2 class="accordion__question">
                What is the best AI text generator?
              </h2>
              <span class="accordion__icon">
                <i id="accordion-icon" class="fa-solid fa-plus"></i>
              </span>
            </div>
            <div class="accordion__content">
              <p class="accordion__answer">
                There are various options you can choose from. It’s important
                to consider the price, the quality of content, and ease of
                use. Our tool uses powerful AI to create original copy,
                provides a built-in conversational AI chat, and offers text
                optimization opportunities. It’s completely free to use and is
                extremely easy to navigate.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="page7">
      <!-- <div class="astroimg">
          <img src="astro2.gif" alt="">
        </div>
        <div class="conform">
          
             <input type="text" placeholder="Your good name">
             <input type="password" placeholder="password">
        </div> -->

      <div class="contact" id="contact">
        <form action="https://api.web3forms.com/submit" method="POST" class="contact-left" id="myform">
          <div class="contact-left-title">
            <h2>Get in touch</h2>
            <hr />
          </div>
          <input type="hidden" name="access_key" value="480a84b9-24ea-4013-875d-6c45ff2e2508" />

          <label>Your Name</label>

          <input type="text" name="name" id="name" placeholder="What's your good name?" class="contact-inputs"
            required />
          <label>Your email</label>

          <input type="email" name="email" id="email" placeholder="What's your web address?" class="contact-inputs"
            required />
          <label>Your Message</label>
          <textarea name="message" id="msg" placeholder="What you want to say?" class="contact-inputs"
            required></textarea>
          <button type="submit">
            Send<i class="fa-solid fa-arrow-right"></i>
          </button>
        </form>
        <div class="contact-right">
          <img src="astro2-ezgif.com-speed.gif" alt="" />

        </div>
      </div>
      <div class="footer">
        <p>Made with ❤️ by &copy Vikrant Kadam</p>
      </div>
    </div>
  </div>
  <script>

    document.addEventListener("DOMContentLoaded", function () {
      var preloader = document.getElementById('preloader');
      var mainContent = document.querySelector('.main');


      setTimeout(function () {
        preloader.style.display = 'none';
        mainContent.style.display = 'block';
        document.body.style.overflow = 'auto';
      }, 5000);
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/locomotive-scroll@3.5.4/dist/locomotive-scroll.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/CSSRulePlugin.min.js"
    integrity="sha512-IxxYrSNXnt/RJlxNX40+7BQL88FLqvdpVpuV9AuvpNH/NFP0L8xA8WLxWTXx6PYExB5R/ktQisp6tIrnLn8xvw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"
    integrity="sha512-onMTRKJBKz8M1TnqqDuGBlowlH0ohFzMXYRNebz+yOcc5TQr/zAKsthzhuv0hiyUKEiQEQXEynnXCvNTOk50dg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://kit.fontawesome.com/5274d0405c.js" crossorigin="anonymous"></script>
  <script src="script.js"></script>
</body>

</html>