<% require css('themes/simple/css/custom-profile.css') %>

<p>Data from profile</p>
$Content;
<p>Data to appear from custom fields</p>
<div class="grid-container">
<% loop $ProfileObjects %>
<div class="grid-item">
    <img class="profile-img" src="$ProfileSource.URL" alt="Profile images" />
    <h3>$Titles</h3>
    <p>$Description</p>
    <%-- looping through categories --%>
    <ul>
        <% loop $ProfileCategories %>
            <li>$ProfileCategoryTitle</li>
        <% end_loop %>
    </ul>
</div>
<% end_loop %>
</div>
<div>

    <%-- looping through another one --%>

    <% loop $ProfileTextObject %>
        <p>$Contents</p>
    <% end_loop %>
</div>