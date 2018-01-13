const voteButton = document.querySelectorAll('.upVote, .downVote');


   voteButton.forEach((button) => {

     button.addEventListener('click', vote);

   });

 function vote(event) {

   const postId = event.target.dataset.post_id;
   const voteDir = event.target.dataset.vote_dir;
   const userId = event.target.dataset.user_id;
   const votes = event.target.parentElement.querySelector('.votes');

   const data = `post_id=${postId}&vote_dir=${voteDir}&user_id=${userId}`;
   const voting = "/../../app/auth/voting.php";
   const voteSum = "/../../app/auth/voteSum.php";

   fetch(voting, {
               method: "POST",
               headers: new Headers({"Content-Type": "application/x-www-form-urlencoded"}),
               credentials: "include",
               body: data
           })

           .then(response => {
             return response.json()
           })

           .then(newSum => {

             fetch(voteSum, {
               method: "POST",
               headers: new Headers({"Content-Type": "application/x-www-form-urlencoded"}),
               credentials: "include",
               body: data
             })

             .then(response => {
               return response.json()
             })

             .then(sum => {
               console.log(sum.sum);

               votes.innerHTML = "Votes: " + sum.sum;
               console.log(votes);
             });
           })


         };
