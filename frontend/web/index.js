const req = new XMLHttpRequest();
const url = 'http://localhost:3333/user';
req.open('GET', url, true);

req.onload = function () {
    if (req.status >= 200 && req.status < 300) {
        try {
            const res = JSON.parse(req.responseText);
            res.forEach(id => {
                console.log(id.id, id.name)
            });
        } catch (error) {
            console.error("Gagal lagi:", error);
        }
    } else {
        console.error('Request failed with status:', req.status);
    }
};

req.send();
console.log("tes");
console.log("tes");