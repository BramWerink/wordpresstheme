<div class="hero">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="speech">
                    <p class="hallo">Hallo,</p>
                    <p class="text">mijn naam is Bram</p>
                    <p class="emoji">👋</p>
                </div>

                <h1 class="title">
                    Product <span id="highlight">designer<span id="title-emoji">🎨</span></span>
                    <br>
                    & front-end <span id="highlight">developer<span id="title-emoji">🕸️</span></span>
                </h1>
                <a class="button-primary" href="#werk">Bekijk mijn werk</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const speechBubble = document.querySelector(".speech");
        const hallo = speechBubble.querySelector(".hallo");
        const text = speechBubble.querySelector(".text");
        const emoji = speechBubble.querySelector(".emoji");
        const title = document.querySelector(".title");
        const button = document.querySelector(".button-primary");

        // Step 1: Show the speech bubble
        setTimeout(() => {
            speechBubble.style.opacity = "1";
        }, 400);

        // Step 2: Show "Hallo"
        setTimeout(() => {
            hallo.style.opacity = "1";
        }, 800);

        // Step 3: Show the text
        setTimeout(() => {
            text.style.opacity = "1";
        }, 1200);

        // Step 4: Show the emoji
        setTimeout(() => {
            emoji.style.opacity = "1";
        }, 1600);

        // Step 5: Show the title
        setTimeout(() => {
            title.style.opacity = "1";
        }, 2000);

        // Step 6: Show the button
        setTimeout(() => {
            button.style.opacity = "1";
        }, 2400);

        // Scroll behavior for anchor links
        const anchors = document.querySelectorAll('a[href^="#"]');
        anchors.forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault(); // Prevent default anchor click behavior
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
    });
</script>
