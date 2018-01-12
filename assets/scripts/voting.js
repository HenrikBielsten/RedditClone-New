const voteLinks = document.querySelectorAll('.upVote, .downVote');

   voteLinks.forEach((link) => {

     link.addEventListener('click', vote);

   });

 function vote(event) {

   const postId = event.target.dataset.post_id;
   const voteDir = event.target.dataset.vote_dir;
   const userId = event.target.dataset.user_id;

   const data = `post_id=${postId}&vote_dir=${voteDir}&user_id=${userId}`;
   const url = "/../../app/auth/voting.php";

   console.log("post id: " + postId);
   console.log("vote direction: " + voteDir);
   console.log("user id: " + userId);

   console.log("This is the data: " + data);

   fetch(url, {
               method: 'POST',
               headers: new Headers({"Content-Type": "application/x-www-form-urlencoded"}),
               credentials: 'include',
               body: data
           })

           .then(response => {
             return response.json()
           })

           // .then(data =>  {
           //   console.log("Response data: " + data);
           // });

         };
