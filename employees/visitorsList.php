<script>

function showCustomer(str) {
  console.log(str)
    if (str.length === 0) {
        document.getElementById("results").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        // readyState four means the request is complete.
        // status 200 means no errors on the page
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
        // grab some variables
        responseText = xmlhttp.responseText;
        json = JSON.parse(responseText);
        indexOfComma = responseText.indexOf(",");

        var names = [];
        var newResponseText = '';
        var i = 1;
        var row = Object.keys(json);
        row.forEach((el) => {
          newResponseText += '<tr><td>' + i + '</td><td>' + json[el].x + '</td><td>' + json[el].y + '</td></tr>';
          i++;
        })

        document.getElementById("results").innerHTML = newResponseText;
        }
    };
    xmlhttp.open("GET", "../services/customerLookup.php?q=" + str, true);
    xmlhttp.send();
    }
}

window.onload = function(){
    document.getElementById('custname').onkeyup = function(){
        var custname =  document.getElementById('custname').value;
        showCustomer(custname);
    };
};

</script>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
  <div class="row text-center mt-3">
    <div class="col-lg-6 col-md-8 mx-auto">
      <div class="card text-white bg-info mb-3">
        <div class="card-body">
          <h2 class="card-title">Todays Tag Animation</h2>
        </div>
        <img class="card-img-bottom" src="<?php echo $base_path . $imgUrl; ?>" alt="beach tag">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8 mx-auto">
      <form>
        <label for="custname">Customer Lookup:</label> <input type="text" id="custname" style="width:80%;">
      </form>
    </div>
  </div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
  <div class="table-responsive w-100">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>First Name</th>
          <th>Last Name</th>
        </tr>
      </thead>
      <tbody id="results">

      </tbody>
    </table>
  </div>
</main>
