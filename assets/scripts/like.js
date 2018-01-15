const likeButton = document.querySelectorAll('.like, .unlike');

  likeButton.forEach((button) => {

    button.addEventListener('click', like);

  });

 function like(event) {

   const likeDir = event.target.dataset.like_dir;
   const otherUser = event.target.dataset.other_user
   const likes = event.target.parentElement.querySelector('.likes');

   const data = `other_user=${otherUser}&like_dir=${likeDir}`;
   const like = "/../../app/auth/like.php";
   const likeSum = "/../../app/auth/likeSum.php";

   fetch(like, {
               method: "POST",
               headers: new Headers({"Content-Type": "application/x-www-form-urlencoded"}),
               credentials: "include",
               body: data
           })

           .then(response => {
             return response.json()
           })

           .then(newSum => {

             fetch(likeSum, {
               method: "POST",
               headers: new Headers({"Content-Type": "application/x-www-form-urlencoded"}),
               credentials: "include",
               body: data
             })

             .then(response => {
               return response.json()
             })

             .then(sum => {
               likes.innerHTML = sum.sum;
             });
           })


         };
