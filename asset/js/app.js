function confirmDelete() {
    return confirm("Bạn có chắc chắn muốn xóa không ?");
}
function checkQuantity() {
    const quantity = document.getElementById("quantity");
    if (quantity.value < 1 || quantity.value == "") {
        alert("Quantity must be greater than 0");
        return false;
    }
    return true;
}

function confirmLogout() {
    return confirm("Bạn có chắc chắn muốn đăng xuất không ?");
}