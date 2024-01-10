<div class="container">
    <div class="row">
        <div class="col-6 col-md-4">
            <div class="card shadow">
                <div class="card-header">
                    <h3>Yeni Dil Paketi Ekle</h3>
                </div>
                <div class="card-body">

                </div>
                <div class="card-footer">
                    <div class="step-footer text-end">
                        <button type="button" class="btn btn-success float-end m-2" onclick="addLangPackage()">Kaydet</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-8">
            <div class="card mr-5">
                <div class="card-body">
                    <table id="langPackageTable" class="table table-striped table-row-bordered gy-5 gs-7">
                        <thead>
                        <tr class="fw-semibold fs-6 text-gray-800">
                            <th scope="col"><b>Seç</b></th>
                            <th scope="col" class="d-none"></th>
                            <th scope="col"><b>Dil Adı</b></th>
                            <th scope="col"><b>Kısa Adı</b></th>
                            <th scope="col"><b>İşlem</b></th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


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
