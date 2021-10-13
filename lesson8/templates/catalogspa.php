
<h2>Каталог</h2>
<div id="text"></div>

<script>

    (async () => {
        const response = await fetch('apicatalog');

        //получаем ответ и парсим его в answer в виде объекта
        const answer = await response.json();

        //По полученным данным рендерим блок каталога и вставляем его в DOM
        document.getElementById('text').innerHTML = render(answer.catalog);
    })().catch(e =>
        document.getElementById('text').innerHTML =
            "<span style='color:red'>Ошибка получения данных!<br>" + e + "</span>"
    );



    //Функция рендера каталога
    function render(catalog) {
        let html = "";
        for (item in catalog) {
            html += "<div>" + catalog[item].name + "<br>";
            html += "Цена: " + catalog[item].price + "<br>";
            html += "<button>Купить</button></div>";
            html += "<hr>";
        }
        return html;
    }

</script>
