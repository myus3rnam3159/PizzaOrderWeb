let currentPageName = location.pathname.substring(location.pathname.lastIndexOf("/") + 1);
let breadcrumbSelector = "#breadcrumb";
let banner = "Trang chủ";

if (!currentPageName) {
  $(breadcrumbSelector).append(createBanner(banner));
} 
//Bài hiện tại
else if (currentPageName === "OrderPizza.php") {
  banner = "Đặt pizza";
  $(breadcrumbSelector).append(createBanner(banner));
}

else if (currentPageName === "EditPizzaOrder.php") {
  banner = "Chỉnh sửa đơn pizza";
  $(breadcrumbSelector).append(createBanner(banner));
}

else if (currentPageName === "Admin.php") {
  banner = "Admin";
  $(breadcrumbSelector).append(createBanner(banner));
}
//Bài khác
else if (currentPageName === "PlayerList.php") {
  banner = "Danh sách cầu thủ";
  $(breadcrumbSelector).append(createBanner(banner));
} else if (currentPageName === "PlayerForm.php") {
  banner = "Thêm cầu thủ";
  $(breadcrumbSelector).append(createBanner(banner));
} else if (currentPageName === "ClubList.php") {
  banner = "Danh sách câu lạc bộ";
  $(breadcrumbSelector).append(createBanner(banner));
}

function createBanner(name) {
  return `<li class="breadcrumb-item text-danger active">${name}</li>`;
}
