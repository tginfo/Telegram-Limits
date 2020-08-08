/// This code is not being used

function run() {
    var search = document.getElementById("search").value.toUpperCase().trim();
    document.getElementById("results").innerHTML = "";

    data.forEach(function (c) {
        var collection = document.createElement("table");
        collection.className = "collection";
        collection.style.setProperty("--vcolor", c.color);

        var header = document.createElement("div");
        header.className = "header";

        collection.appendChild(header);

        var hIcon = document.createElement("md-icon");
        hIcon.innerText = c.icon;
        header.appendChild(hIcon);

        var hName = document.createElement("caption");
        hName.className = "name";
        hName.innerText = c.name;
        header.appendChild(hName);


        var card = document.createElement("tbody");
        card.className = "card";
        collection.appendChild(card);

        var count = 0;

        c.items.forEach(function (i) {
            if (search.length > 0) {
                if (c.name.toUpperCase().indexOf(search) === -1
                    && i.name.toUpperCase().indexOf(search) === -1
                    && i.hint.toUpperCase().indexOf(search) === -1
                    && i.text.toUpperCase().indexOf(search) === -1) {
                    return;
                }
            }
            count++;

            var item = document.createElement("tr");
            item.className = "item";
            card.appendChild(item);

            var icon = document.createElement("md-icon");
            icon.innerText = i.icon;
            item.appendChild(icon);

            var content = document.createElement("div");
            content.className = "content";
            item.appendChild(content);

            var title = document.createElement("th");
            title.className = "title";
            content.appendChild(title);
            title.innerText = i.name + " ";

            var info = document.createElement("span");
            info.className = "info";
            title.appendChild(info);
            info.innerText = i.hint;

            var data = document.createElement("td");
            data.className = "data";
            content.appendChild(data);
            data.innerText = i.text;
        });

        if (count === 0) return;
        document.getElementById("results").appendChild(collection);
    });

    position();
}