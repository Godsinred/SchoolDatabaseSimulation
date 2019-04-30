// helper functions for the html page

// updates the dropdown list of the search types
function updateSearchType()
{
  // gets the objects of the drop down menus
  var userDropDown = document.getElementById("userType");
  var searchTypeDropDown = document.getElementById("searchType");

  // checks which drop down menu was selected and updates accordingly
  if(userDropDown.value == "Professor")
  {
    searchTypeDropDown.options[0].text = "Social Security Number";
    searchTypeDropDown.options[1].text = "Course Number";
    updateFormOptions();
  }
  else
  {
    searchTypeDropDown.options[0].text = "Course Number";
    searchTypeDropDown.options[1].text = "Campus Wide ID";
    updateFormOptions();
  }
}

// updates the form seraech label accordingly
function updateFormOptions()
{
  // gets the objects of the drop down menus
  var userDropDown = document.getElementById("userType");
  var searchTypeDropDown = document.getElementById("searchType");
  var searchForm = document.getElementById("searchForm");
  var hiddenSearch1 = document.getElementById("searchFieldHidden1");
  var hiddenSearch2 = document.getElementById("searchFieldHidden2");

  if(userDropDown.value == "Professor" && searchTypeDropDown.value == "questionB")
  {
    // Adds an element to the form for section number
    var newElement = document.createElement("input");
    newElement.setAttribute("id", "searchField2");
    newElement.setAttribute("type", "text");
    newElement.setAttribute("name", "search2");
    searchForm.appendChild(newElement);

    // updates the text for the search
    document.getElementById("search1Text").innerHTML = "Course Number";
    document.getElementById("search2Text").innerHTML = "Section Number";
    hiddenSearch1.value = "Professor";
    hiddenSearch2.value = "questionB";

  }
  else if(userDropDown.value == "Professor" && searchTypeDropDown.value == "questionA")
  {
    removeExtraSearch();

    // updates the text field of the search label
    document.getElementById("search1Text").innerHTML = "Social Security Number";

    hiddenSearch1.value = "Professor";
    hiddenSearch2.value = "questionB";
  }
  else if(userDropDown.value == "Student" && searchTypeDropDown.value == "questionA")
  {
    removeExtraSearch();

    // updates the text field of the search label
    document.getElementById("search1Text").innerHTML = "Course Number";

    hiddenSearch1.value = "Student";
    hiddenSearch2.value = "Course Number";
  }
  else
  {
    removeExtraSearch();

    // updates the text field of the search label
    document.getElementById("search1Text").innerHTML = "Campus Wide ID";

    hiddenSearch1.value = "Student";
    hiddenSearch2.value = "Campus Wide ID";
  }
}

// removes the extra search parameters if it exists
function removeExtraSearch()
{
  // removes the extra search field from the form
  var removeSearch2 = document.getElementById("searchField2");
  // checks to make sure it exists before trying to delete it
  if(!!removeSearch2)
  {
    removeSearch2.parentNode.removeChild(removeSearch2);

    // removes the text
    document.getElementById("search2Text").innerHTML = "";
  }
}

function createActionGetRequest()
{
  event.preventDefault();

  var form = document.getElementById("searchForm");
  var elements = form.elements;
  var values = [];

  for (var i = 0; i < elements.length; i++)
  {
    values.push(encodeURIComponent(elements[i].name) + '=' + encodeURIComponent(elements[i].value));
  }

  var userForm = document.getElementById("userType");
  values.push(encodeURIComponent("userType") + '=' + encodeURIComponent(userForm.value));

  var searchForm = document.getElementById("searchType");
  values.push(encodeURIComponent("searchType") + '=' + encodeURIComponent(searchForm.value));

  // dummy test for GET request
  form.action = "http://ecs.fullerton.edu/~cs332t19/index.php?" + "search1=987654321" + '&' + "search2=987654321";
  console.log(form.action);
  alert('pause');
  form.submit();
}
