async function loadPost() {
  // Берем значение из фильтров
  document.querySelector(".center").innerHTML = "";
  let limit = document.getElementById("sel").value;
  let filter = document.querySelector('input[name="filter"]:checked').value;

  let form = {
    limit,
    filter,
  };

  // Делаем запрос на post
  let res = await fetch(`/post/filter/${filter}/${limit}`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json;charset=utf-8",
    },
    body: JSON.stringify(form),
  });

  let data = await res.json();
  console.log(data);
  // Выводим полученный объект через цикл forEach
  data.forEach((post) => {
    let ms = post.time_create,
      dmy = [],
      date = new Date(ms * 1000);
    dmy = [
      ("0" + date.getDate()).slice(-2),
      ("0" + (date.getMonth() + 1)).slice(-2),
      date.getFullYear(),
    ];

    document.querySelector(".center").innerHTML += `
      <div class="card">
                <div class="card-body text-center">
                  <h4 class="card-title">${post.title}</h4>
                  <p class="card-text">${post.description}</p>
                  <a href="/post/${post.id}" class="card-link">Перейти</a>
                  <p class=" text-muted">
                   Views : ${post.views}
                </p>
                <p class=" text-muted">
                   ${dmy.join(".")}
                </p>
                </div>
              </div>
      `;
  });
}
