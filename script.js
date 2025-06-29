function validateForm() {
  const checkin = new Date(document.getElementById("checkin").value);
  const checkout = new Date(document.getElementById("checkout").value);

  if (checkin >= checkout) {
    alert("Check-out must be after Check-in!");
    return false;
  }
  return true;
}
