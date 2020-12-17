var $ = window.jQuery;

function callHP() {
  console.log("HP");
  $.post(
    "server/payment.php",
    {
      option: 0,
      amount: 1000,
      currency: "GBP",
      reference: "hp_example",
      country: "GB",
      customerName: "Jack Napier",
      customerEmail: "jokershere@gmail.com"
    },
    function (data, status) {
      console.log(data);
      window.location = data;
    }
  );
}

function callAPM() {
  console.log("APM");
  $.post(
    "server/payment.php",
    {
      option: 1,
      amount: 1000,
      currency: "EUR",
      reference: "hp_example",
      country: "GB",
      customerName: "Jack Napier",
      customerEmail: "jokershere@gmail.com"
    },
    function (data, status) {
      console.log(data);
      window.location = data;
    }
  );
}
