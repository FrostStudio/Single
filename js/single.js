/* ----

# Single Theme
# By: Dreamer-Paul
# Last Update: 2017.8.2

一个简洁大气，含夜间模式的 Typecho 博客模板。

欢迎你加入缤奇，和我们一起改变世界。
本代码为缤奇保罗原创，并遵守 MIT 开源协议。保罗的个人博客：https://hi-paul.space

 ---- */

// 菜单按钮
function head_menu() {
    var btn = document.getElementsByClassName("toggle-btn")[0];
    var menu = document.getElementsByClassName("head-menu")[0];
    btn.addEventListener("click", function () {
        menu.classList.toggle("active");
    })
}
head_menu();

// 搜索按钮
function search_btn() {
    var btn = document.getElementsByClassName("search-btn")[0];
    var bar = document.getElementsByClassName("search-form")[0];
    btn.addEventListener("click", function () {
        bar.classList.toggle("active");
    })
}
search_btn();

// 关灯切换
function style_select() {
    var body = document.body;
    var neon_btn = document.getElementsByClassName("light-btn")[0];

    function style_load() {
        if(localStorage.style == "neon"){
            body.classList.add("neon");
        }
    }
    style_load();

    neon_btn.addEventListener("click", function () {
        switch (body.classList.contains("neon")){
            case true: body.classList.remove("neon"); style_save(null); break;
            case false: body.classList.add("neon"); style_save("neon"); break;
        }
        function style_save(style) {
            localStorage.style = style;
        }
    });
}
style_select();

// 返回页首
function turn_up() {
    var btn = document.getElementsByClassName("turn-up")[0];
    var scroll = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;

    if(scroll >= window.innerHeight / 2) {
        btn.classList.add("active");
    }
    else {
        btn.classList.remove("active");
    }
}

window.onscroll = function () {
    turn_up();
};

if (window.console && window.console.log) {
    console.log("\n %c Single %c https://hi-paul.space \n\n","color: #fff; background: #ffa628; padding:5px 0;","background: #efefef; padding:5px 0;");
}