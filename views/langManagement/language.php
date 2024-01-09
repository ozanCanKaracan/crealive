<div>
    <p id="originalText">Hello, world!</p>
    <button onclick="translateText()">Translate</button>
    <p id="translatedText"></p>
</div>

<script>
    function translateText() {
        const originalText = document.getElementById("originalText").innerText;

        // Google Translate API Endpoint ve API Key'i
        const endpoint = "https://translation.googleapis.com/language/translate/v2";
        const apiKey = "AIzaSyBdH8gjaAKplDXc_rxfTAHI9wCjxTO_U70"; // Buraya kendi API anahtarınızı ekleyin

        // Hedef dil
        const targetLanguage = "tr"; // Almanca

        // Google Translate API çağrısı
        fetch(`${endpoint}?key=${apiKey}&q=${originalText}&target=${targetLanguage}`, {
            method: "POST"
        })
            .then(response => response.json())
            .then(data => {
                const translatedText = data.data.translations[0].translatedText;
                document.getElementById("translatedText").innerText = translatedText;
            })
            .catch(error => console.error("Translation error:", error));
    }
</script>
