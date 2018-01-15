const sortDate = document.querySelector('.sortDate');
const sortScore = document.querySelector('.sortScore');

sortDate.addEventListener('click', date);

sortDate.addEventListener('click', score);

function date(event) {
  const sort = event.target.dataset.sort;

  const data = `sort=${sort}`;
  const sort = "index.php";

  fetch(sort, {
              method: "POST",
              headers: new Headers({"Content-Type": "application/x-www-form-urlencoded"}),
              credentials: "include",
              body: data
          })

          .then(response => {
            return response.json()
          })
        };
