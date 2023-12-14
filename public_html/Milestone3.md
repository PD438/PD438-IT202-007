<table><tr><td> <em>Assignment: </em> IT202 Milestone 3 API Project</td></tr>
<tr><td> <em>Student: </em> Paulo Duarte (pd438)</td></tr>
<tr><td> <em>Generated: </em> 12/13/2023 4:15:29 PM</td></tr>
<tr><td> <em>Grading Link: </em> <a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-007-F23/it202-milestone-3-api-project/grade/pd438" target="_blank">Grading</a></td></tr></table>
<table><tr><td> <em>Instructions: </em> <ol><li>Checkout Milestone3 branch</li><li>Create a new markdown file called milestone3.md</li><li>git add/commit/push immediate</li><li>Fill in the below deliverables</li><li>At the end copy the markdown and paste it into milestone3.md</li><li>Add/commit/push the changes to Milestone3</li><li>PR Milestone3 to dev and verify</li><li>PR dev to prod and verify</li><li>Checkout dev locally and pull changes just to be up to date</li><li>Submit the direct link to this new milestone3.md file from your GitHub prod branch to Canvas</li></ol><p>Note: Ensure all images appear properly on github and everywhere else. Images are only accepted from dev or prod, not local host. All website links must be from prod (you can assume/infer this by getting your dev URL and changing dev to prod).</p></td></tr></table>
<table><tr><td> <em>Deliverable 1: </em> API Data Association </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Consider how your API data will be associated with a user</td></tr>
<tr><td> <em>Response:</em> <p>the API data will be associated&nbsp; by liked_recipes.php<br>and while the user likes the<br>recipes then it will show on recipes i liked tab and will reveal<br>the recipes that the user likes.&nbsp;&nbsp;<br></p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> Handling Data Changes</td></tr>
<tr><td> <em>Response:</em> <p>The API would be involved because it is clicking on the recipe the<br>user liked and once the user likes the recipe, it will show the<br>user what he has liked through a series of queries. The logic that<br>i had was to make this as very user friendly.&nbsp;<br></p><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 2: </em> Handle the association of data to a user </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Which option did you need to do to handle the association of data?</td></tr>
<tr><td> <em>Response:</em> <p>what i have done is create a like button and being able to<br>have the user like a recipe. once they like the recipe, then the<br>user can be able to see what recipes they liked. User will be<br>able to see what they only like.&nbsp;&nbsp;<br>But the problem i am having is<br>that i have placed the code for it to work and it is<br>not displaying on the site.&nbsp;<br><br>it is not showing the recipes that i liked.&nbsp;<br></p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add screenshots of the updated/created pages related to associating data with the user (include code screenshots)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fpd438%2F2023-12-13T16.52.11image.png.webp?alt=media&token=19e5a3e6-ed31-4c56-be67-e5440a22aa0a"/></td></tr>
<tr><td> <em>Caption:</em> <p>my goal was for the user to be able to like the recipes.<br> unfortunately, it did not work that way<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fpd438%2F2023-12-13T17.11.18image.png.webp?alt=media&token=c496266d-daa6-49cf-942c-fa23b371e2aa"/></td></tr>
<tr><td> <em>Caption:</em> <p>once you clicked on the like a recipe.  it would work and<br>then show <br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Include any Heroku prod links to pages that would trigger entity to user association</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://it202pd438-prod-23-ebfd5355f1ca.herokuapp.com/project/search_form.php">https://it202pd438-prod-23-ebfd5355f1ca.herokuapp.com/project/search_form.php</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Include any PRs related to this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/PD438/PD438-IT202-007/pull/38">https://github.com/PD438/PD438-IT202-007/pull/38</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 3: </em> Logged in user’s associated entities page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> What is the data that's associated with the user?</td></tr>
<tr><td> <em>Response:</em> <p>the item that is associated is the recipeID and the userID for it<br>to be correlated with what the user has created for liking the recipe.&nbsp;<br></p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> Show screenshots of the logged in user's entities associated with them  (include code screenshots)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fpd438%2F2023-12-13T21.01.43image.png.webp?alt=media&token=ce2ffb4e-f8bc-4ef0-80c2-e19cbd584c6d"/></td></tr>
<tr><td> <em>Caption:</em> <p>this page was suppose to be where the user would see what they<br>have liked linking from the API.  But the roadblock was because of<br>the mapping did not correlate with the page. <br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add Heroku Prod links to the page(s) where the logged in user has their entities listed</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://it202pd438-prod-23-ebfd5355f1ca.herokuapp.com/project/liked_recipes.php">https://it202pd438-prod-23-ebfd5355f1ca.herokuapp.com/project/liked_recipes.php</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Include any PRs related to this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/PD438/PD438-IT202-007/pull/39">https://github.com/PD438/PD438-IT202-007/pull/39</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 4: </em> All Users association page (Note: This will likely be an admin page and is not the same as the previous item) </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Describe/Explain the purpose of this page from your project perspective</td></tr>
<tr><td> <em>Response:</em> <p>The purpose of this page for the admin to see what users liked<br>what recipes and be able to give the information to the admin as<br>a way to keep track of favorite cusines.&nbsp; i was able to get<br>the admin to be able to see a recipe and like the recipe.&nbsp;<br>But it did not display it to the site.&nbsp;<br></p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> Show screenshots of the entity data associated with many users (include code screenshots)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fpd438%2F2023-12-13T21.04.27image.png.webp?alt=media&token=cdea26e7-47dd-43e2-8987-9b89c4ded61b"/></td></tr>
<tr><td> <em>Caption:</em> <p>this would show where the user would see their liked recipes <br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fpd438%2F2023-12-13T21.05.00image.png.webp?alt=media&token=d1c17d87-88ba-4266-a3f1-8bd8c73a7c7f"/></td></tr>
<tr><td> <em>Caption:</em> <p>here is how it looked on visual studio code.  but it would<br>not work to appear on the site.  but this would be where<br>if the admin wanted to see, the liked recipes on the site. <br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add Heroku Prod links to the page(s) where entities associated to many users can be seen</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://it202pd438-prod-23-ebfd5355f1ca.herokuapp.com/project/liked_recipes.php">https://it202pd438-prod-23-ebfd5355f1ca.herokuapp.com/project/liked_recipes.php</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Include any PRs related to this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/PD438/PD438-IT202-007/pull/39">https://github.com/PD438/PD438-IT202-007/pull/39</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 5: </em> Create a page that shows data not associated with any user (Note: This will likely be an admin page and is not the same as the previous item) </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707834-bf5a5b13-ec36-4597-9741-aa830c195be2.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Show screenshots of the page showing entities not associated with anyone (include code screenshots)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fpd438%2F2023-12-13T21.07.14image.png.webp?alt=media&token=0115add6-8d49-4d65-a86b-fdf6ccda0530"/></td></tr>
<tr><td> <em>Caption:</em> <p>this is the general search where no user would be able to see<br>what other users would see. <br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add Heroku Prod links to the page(s) where unassociated entities can be seen</td></tr>
<tr><td>Not provided</td></tr>
<tr><td> <em>Sub-Task 3: </em> Include any PRs related to this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/PD438/PD438-IT202-007/pull/39">https://github.com/PD438/PD438-IT202-007/pull/39</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 6: </em> Admin can associate any entity with any users (Note: This may be a form on an existing association page if you rather not have a separate page for this) </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots showing evidence of the checklist items (include code screenshots)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fpd438%2F2023-12-13T21.12.21image.png.webp?alt=media&token=735a31f6-d9b8-40e1-9cfb-d2e8858c1291"/></td></tr>
<tr><td> <em>Caption:</em> <p><a href="https://it202pd438-prod-23-ebfd5355f1ca.herokuapp.com/project/admin/assign_roles.php">https://it202pd438-prod-23-ebfd5355f1ca.herokuapp.com/project/admin/assign_roles.php</a><br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explain the code logic for this page</td></tr>
<tr><td> <em>Response:</em> <p>for each user if the admin were to be able to assign roles,<br>they would find the username and be able to link the role to<br>the user and grant them permissions to do what they need to. Very<br>similiar to the Sharepoint sites.&nbsp;<br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add Heroku Prod links to the page(s) related to this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://it202pd438-prod-23-ebfd5355f1ca.herokuapp.com/project/admin/assign_roles.php">https://it202pd438-prod-23-ebfd5355f1ca.herokuapp.com/project/admin/assign_roles.php</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Include any PRs related to this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/PD438/PD438-IT202-007/pull/39">https://github.com/PD438/PD438-IT202-007/pull/39</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 7: </em> Reflection </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Document any issues/struggles</td></tr>
<tr><td> <em>Response:</em> <p>the biggest struggle i had with the project was being able to find<br>a proper way for the user to be able to have the association<br>and having the table actually work with the file.&nbsp; To be honest, it<br>was extremely frustrating that i was not able to get over this hurdle.&nbsp;<br>I had so many ideas for the user to be able to access<br>this site with ease. My goal was for this site to be able<br>to easily accessed and have the user be able to like recipes and<br>actually try these recipes out.&nbsp;&nbsp;<br></p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> Highlight any favorite topics</td></tr>
<tr><td> <em>Response:</em> <p>my favorite thing was creating the game.&nbsp; Reminded me of those days when<br>i was young, those websites such as miniclips.com and mofunzone. com playing those<br>games during my technology class and being able to see what inspired the<br>older generation of game developers to create their game and make it very<br>successful.&nbsp; So doing the game really brought me back to that moment when<br>i was young. And it made it alot of fun.<br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Overall how do you feel you did with the project and meeting requirements</td></tr>
<tr><td> <em>Response:</em> <p>I feel like i did pretty decent with the project. I felt like<br>not understanding what it was originally about, made me feel like I just<br>chose the api in order to satisfy the requirements. I def would have<br>picked something that has inspired me rather than just picking an item that<br>was from the top.&nbsp; &nbsp;Am i honestly happy with the results that i<br>got, I honestly feel like i can do a whole lot better if<br>given another chance since i now understand what this project was about.&nbsp; Overall,<br>it was actually alot of fun to do this project.&nbsp;<br></p><br></td></tr>
<tr><td> <em>Sub-Task 4: </em> Summarize your experience per the checklist items</td></tr>
<tr><td> <em>Response:</em> <p>I honestly had 0 experience with web development.&nbsp; To me, everything that the<br>professor talked in the beginning was a whole new language for me.&nbsp; I<br>am super happy i took this class with professor Togel because he really<br>helped me alot with learning the course.&nbsp; I honestly feel a whole lot<br>better becasue i actually understand what is currently happening.&nbsp; If i would do<br>something different, i would completely do a different api because of how it<br>has issues for the user.&nbsp; &nbsp;<br></p><br></td></tr>
</table></td></tr>
<table><tr><td><em>Grading Link: </em><a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-007-F23/it202-milestone-3-api-project/grade/pd438" target="_blank">Grading</a></td></tr></table>