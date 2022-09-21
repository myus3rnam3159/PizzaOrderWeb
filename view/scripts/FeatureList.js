let features = [
  { name: "Đặt pizza", path: "./view/OrderPizza.php" },
  { name: "Xem chi tiết và cập nhật đơn hàng pizza", path: "./view/EditPizzaOrder.php" },
  { name: "Admin", path: "./view/Admin.php" },
  
];

let featureListTemplate = "";
let featureListSize = features.length;
let i = 0;

while (i < featureListSize) {
  featureListTemplate += '<li href="/" class="list-group-item d-flex justify-content-between align-items-center">';
  featureListTemplate += buildATag(features[i].name, features[i].path);
  featureListTemplate += "</li>";

  i++;
}
$("#feature-list").append(featureListTemplate);

function buildATag(name, path) {
  return `<a href="${path}">${name}</a>`;
}
