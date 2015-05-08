// Copy from Wu Xiangxin's homework :)

//创建和初始化地图函数：
function initMap() {
    createMap();//创建地图
    setMapEvent();//设置地图事件
    addMapControl();//向地图添加控件
    addMarker();//向地图中添加marker
	createLine();
}

//创建地图函数：
function createMap() {
    var map = new BMap.Map("baiduMapInfo");//在百度地图容器中创建一个地图
    var point = new BMap.Point(114.413195, 30.512973);//定义一个中心点坐标
    map.centerAndZoom(point, 17);//设定地图的中心点和坐标并将地图显示在地图容器中
    window.map = map;//将map变量存储在全局
}

//地图事件设置函数：
function setMapEvent() {
    map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
    map.enableScrollWheelZoom();//启用地图滚轮放大缩小
    map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
    map.enableKeyboard();//启用键盘上下左右键移动地图
}

//地图控件添加函数：
function addMapControl() {
    //向地图中添加缩放控件
    var ctrl_nav = new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_LEFT, type: BMAP_NAVIGATION_CONTROL_LARGE});
    map.addControl(ctrl_nav);
    //向地图中添加缩略图控件
   // var ctrl_ove = new BMap.OverviewMapControl({anchor: BMAP_ANCHOR_BOTTOM_RIGHT, isOpen: 0});
 //   map.addControl(ctrl_ove);
    //向地图中添加比例尺控件
    var ctrl_sca = new BMap.ScaleControl({anchor: BMAP_ANCHOR_BOTTOM_LEFT});
    map.addControl(ctrl_sca);
}

//标注点数组
var markerArr = [{title: "我们的位置", content: "我的备注", point: "114.410922|30.512164", isOpen: 0, icon: {w: 21, h: 21, l: 0, t: 0, x: 6, lb: 5}}];

//创建marker
function addMarker() {
    for (var i = 0; i < markerArr.length; i++) {
        var json = markerArr[i];
        var p0 = json.point.split("|")[0];
        var p1 = json.point.split("|")[1];
        var point = new BMap.Point(p0, p1);
        var iconImg = createIcon(json.icon);
        var marker = new BMap.Marker(point, {icon: iconImg});
        var label = new BMap.Label(json.title, {"offset": new BMap.Size(json.icon.lb - json.icon.x + 10, -20)});
        marker.setLabel(label);
        map.addOverlay(marker);
        label.setStyle({
            borderColor: "#808080",
            color: "#333",
            cursor: "pointer"
        });

        (function () {
            var _iw = createInfoWindow(i);
            var _marker = marker;
            _marker.addEventListener("click", function () {
                this.openInfoWindow(_iw);
            });
            _iw.addEventListener("open", function () {
                _marker.getLabel().hide();
            });
            _iw.addEventListener("close", function () {
                _marker.getLabel().show();
            });
            label.addEventListener("click", function () {
                _marker.openInfoWindow(_iw);
            });
            if (!!json.isOpen) {
                label.hide();
                _marker.openInfoWindow(_iw);
            }
        })()
    }
}

//创建InfoWindow
function createInfoWindow(i) {
    var json = markerArr[i];
    return new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>" + json.content + "</div>");
}

//创建一个Icon
function createIcon(json) {
    return new BMap.Icon("http://app.baidu.com/map/images/us_mk_icon.png", new BMap.Size(json.w, json.h), {
        imageOffset: new BMap.Size(-json.l, -json.t),
        infoWindowOffset: new BMap.Size(json.lb + 5, 1),
        offset: new BMap.Size(json.x, json.h)
    });
}
//创建折线
function createLine(){
	var arrLine = [
			new BMap.Point(114.437, 30.514),
			new BMap.Point(114.431, 30.514),
			new BMap.Point(114.426, 30.516),
			new BMap.Point(114.433, 30.518),
			new BMap.Point(114.437, 30.514)
		];
	var polyline = new BMap.Polyline(arrLine, {strokeColor:"blue", strokeWeight:2, strokeOpacity:0.5});   //创建折线
	map.addOverlay(polyline); 
	
	var lushu =  new BMapLib.LuShu(map,arrLine,{
            defaultContent:"",//"从天安门到百度大厦"
            autoView:true,//是否开启自动视野调整，如果开启那么路书在运动过程中会根据视野自动调整
            icon  : new BMap.Icon('../../images/map/car.png', new BMap.Size(52,26),{anchor : new BMap.Size(27, 13)}),
            speed: 200,
            enableRotation:true,//是否设置marker随着道路的走向进行旋转
			landmarkPois:""
            }); 
	lushu.start();
}


//创建和初始化地图
initMap();

