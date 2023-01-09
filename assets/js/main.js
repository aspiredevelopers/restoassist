$(document).ready(function () {
  $(".datatable").DataTable({});
  $("#summernote").summernote({
    placeholder: "Enter Description",
    tabsize: 2,
    height: 100,
  });
});

function isBackAvailable() {
  if (document.referrer === "") return false;
  if (!document.referrer.startsWith("http://localhost")) return false;

  return true;
}

function goBack() {
  if (isBackAvailable()) {
    history.go(-1);
  }
}

function goNext() {
  history.go(1);
}

$(document).ready(function () {
  if (!isBackAvailable()) {
    $("#back-button").addClass("disabled-btn");
  }
});

setTimeout(function () {
  $(".alert").alert("close");
}, 3000);

function changeNav(nav, title) {
  $("." + nav).addClass("active");
  $(".title").text(title);
}

$(".hamburger-btn").click(function (e) {
  e.preventDefault();
  $(".hb-close-btn").toggleClass("d-none");
  $(".hamburger-btn").toggleClass("d-none");
  $("#sidebar-div").removeClass("d-none");
  $("body").css("overflow-y", "hidden");
})

$(".hb-close-btn").click(function (e) {
  e.preventDefault();
  $(".hb-close-btn").toggleClass("d-none");
  $(".hamburger-btn").toggleClass("d-none");
  $("#sidebar-div").addClass("d-none");
  $("body").css("overflow-y", "auto");
})

function changeSubNav(nav, subnav, title) {
  $("." + nav).addClass("active");
  $("." + subnav).addClass("sub-active");
  $(".title").text(title);
  $("." + nav).click();
}

$("#item").change(function () {
  var searchVal = $("#item").val();
  if (searchVal != "") {
    $.ajax({
      type: "POST",
      url: "functions/functions",
      data: {
        search_item: true,
        item: searchVal,
      },
      success: function (html) {
        $("#price").val(html);
      },
    });
  } else {
  }
});

$(document).on("click", ".drop", function () {
  $(this).find(".arrow").removeClass("bi-caret-right-fill");
  $(this).find(".arrow").addClass("bi-caret-down-fill");
  $(this).parents(".nav-dropdown").addClass("bg-f5");
  $(this)
    .parents(".nav-dropdown")
    .find(".nav-subdropdown")
    .removeClass("d-none");
  $(this).removeClass("drop");
  $(this).addClass("drop-active");
});

$(document).on("click", ".drop-active", function () {
  $(this).find(".arrow").addClass("bi-caret-right-fill");
  $(this).find(".arrow").removeClass("bi-caret-down-fill");
  $(this).parents(".nav-dropdown").removeClass("bg-f5");
  $(this).parents(".nav-dropdown").find(".nav-subdropdown").addClass("d-none");
  $(this).addClass("drop");
  $(this).removeClass("drop-active");
});

function setInputDate(id) {
  var day = new Date().getDate();
  var month = new Date().getMonth() + 1;
  var year = new Date().getFullYear();

  if (day < 10) {
    day = "0" + day;
  }
  if (month < 10) {
    month = "0" + month;
  }

  var today = year + "-" + month + "-" + day;
  $("#" + id).val(today);
}

$("#item").keydown(function (event) {
  if (event.keyCode == 13) {
    $("#price").focus();
    event.preventDefault();
    return false;
  }
});

$("#price").keydown(function (event) {
  if (event.keyCode == 13) {
    $("#qty").focus();
    event.preventDefault();
    return false;
  }
});

$("#qty").keydown(function (event) {
  if (event.keyCode == 13) {
    $("#add").focus();
    event.preventDefault();
    return false;
  }
});


var editRow = null;

function testDisplay(ctl) {
  editRow = $(ctl).parents("tr");
  var cols = editRow.children("td");

  $("#item").val($(cols[1]).find("input").val());
  $("#price").val($(cols[2]).find("input").val());
  $("#qty").val($(cols[3]).find("input").val());

  $("#add").text("Update");
}

function testUpdate() {
  if ($("#item").val() !== "" && $("#qty").val().length > 0) {
    if ($("#add").text() == "Update") {
      testUpdateInTable();
      $("#item").trigger("focus");
    } else {
      testAddToTable();
    }

    formClear();
    sumPrice();

    $("#item").focus();
  } else {
    alert("Please enter item & qty!");
  }
}

function testAddToTable() {
  if ($("#cbTable tbody").length == 0) {
    $("#cbTable").append("<tbody></tbody>");
  }

  $("#cbTable tbody").append(testBuildTableRow());
}

// Update product in <table>
function testUpdateInTable() {
  // Add changed product to table
  $(editRow).after(testBuildTableRow());
  formClear();
  // Remove original product
  $(editRow).remove();

  // Clear form fields
  formClear();

  // Change Update Button Text
  $("#add").text("Add");
}

// Build a <table> row of Product data
function testBuildTableRow() {

  var price = parseFloat($("#price").val());
  var qty = parseFloat($("#qty").val());
  var total = price * qty;

  var ret =
    "<tr>" +
    "<td class='fit sl'></td>" +
    "<td><input type='text' class='none item' name='item[]' value='" +
    $("#item")
      .val()
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;") +
    "' readonly></td>" +
    "<td><input type='text' class='none price-cell' name='price[]' value='" +
    $("#price").val() +
    "' readonly></td>" +
    "<td><input type='text' class='none qty' name='qty[]' value='" +
    $("#qty").val() +
    "' readonly></td>" +
    "<td><input type='text' class='none total-cell' name='total[]' value='" +
    total +
    "' readonly></td>" +
    "<td class='fit'>" +
    "<button type='button' " +
    "onclick='testDisplay(this);' " +
    "class='btn btn-primary btn-sm'>" +
    "<i class='bi bi-pencil' ></i>" +
    "</button>" +
    "</td>" +
    "<td class='fit'>" +
    "<button type='button' " +
    "onclick='testDelete(this);' " +
    "class='btn btn-danger btn-sm'>" +
    "<i class='bi bi-trash' ></i>" +
    "</button>" +
    "</td>" +
    "</tr>";
  return ret;
}

// Delete product from <table>
function testDelete(ctl) {
  $(ctl).parents("tr").remove();
  $("#add").text("Add");
  sumPrice();
}

// Clear form fields
function formClear() {
  $("#item").val("");
  $("#price").val("");
  $("#qty").val("");
}

$("#item").keydown(function (event) {
  if (event.keyCode == 13) {
    event.preventDefault();
    return false;
  }
});

$("#gt").keydown(function (event) {
  if (event.keyCode == 13) {
    event.preventDefault();
    $("#add-order").trigger("focus");
  }
});

$("#st").keydown(function (event) {
  if (event.keyCode == 13) {
    event.preventDefault();
    $("#dis").trigger("focus");
  }
});

$("#dis").keydown(function (event) {
  if (event.keyCode == 13) {
    event.preventDefault();
    $("#gt").trigger("focus");
  }
});

function sumPrice() {
  var TotalValue = 0;
  $("tr .total-cell").each(function (index, value) {
    currentRow = parseFloat($(this).val());
    TotalValue += currentRow;
  });

  $("#st").val(TotalValue);

  var subtotal = parseFloat($("#st").val());
  var discount = parseFloat($("#dis").val());
  var gt = subtotal - discount;

  $("#gt").val(gt);
}

$("#dis").keyup(function () {
  if ($(this).val() == "") {
    $(this).val("0.00");
    $(this).select();
  }

  var subtotal = parseFloat($("#st").val());
  var discount = parseFloat($(this).val());
  var gt = subtotal - discount;

  $("#gt").val(gt);
});

$(".edit-desg").click(function () {
  $(this).parents("tr").find(".desg-input").removeClass("blank-input");
  $(this).parents("tr").find(".desg-input").attr("readonly", false);
  $(this).parents("tr").find(".update-btn").removeClass("d-none");
  $(this).parents("tr").find(".remove-desg").removeClass("d-none");
  $(this).parents("tr").find(".desg-input").focus();
})

$(".remove-desg").click(function () {
  $(this).parent().find(".desg-input").addClass("blank-input");
  $(this).parent().find(".desg-input").attr("readonly", true);
  $(this).parent().find(".update-btn").addClass("d-none");
  $(this).parent().find(".remove-desg").addClass("d-none");
})

$(".edit-item").click(function () {
  $(this).parents("tr").find(".title-input").removeClass("blank-input");
  $(this).parents("tr").find(".title-input").attr("readonly", false);
  $(this).parents("tr").find(".price-input").removeClass("blank-input");
  $(this).parents("tr").find(".price-input").attr("readonly", false);
  $(this).parents("tr").find(".update-btn").removeClass("d-none");
  $(this).parents("tr").find(".remove-item").removeClass("d-none");
  $(this).parents("tr").find(".title-input").focus();
})

$(".remove-item").click(function () {
  $(this).parents("tr").find(".title-input").addClass("blank-input");
  $(this).parents("tr").find(".title-input").attr("readonly", true);
  $(this).parents("tr").find(".price-input").addClass("blank-input");
  $(this).parents("tr").find(".price-input").attr("readonly", true);
  $(this).parents("tr").find(".update-btn").addClass("d-none");
  $(this).parents("tr").find(".remove-item").addClass("d-none");
})