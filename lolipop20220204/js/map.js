let myLatLng = new google.maps.LatLng(35.6811673, 139.7670516); //初期の中心座標を決める変数
let options = {
    //初期状態を定める変数
    zoom: 10, //初期状態の地図の縮尺値
    center: myLatLng, //指定した変数の値を初期状態の地図の中心座標にする
    mapTypeId: "roadmap", //初期状態の地図の種類
    styles: [{
            featureType: "landscape",
            elementType: "all",
            stylers: [{
                visibility: "on",
            }, ],
        },
        {
            featureType: "poi.business",
            elementType: "all",
            stylers: [{
                visibility: "simplified",
            }, ],
        },
        {
            featureType: "poi.business",
            elementType: "labels",
            stylers: [{
                visibility: "simplified",
            }, ],
        },
        {
            featureType: "poi.park",
            elementType: "all",
            stylers: [{
                visibility: "off",
            }, ],
        },
        {
            featureType: "poi.school",
            elementType: "all",
            stylers: [{
                visibility: "on",
            }, ],
        },
        {
            featureType: "poi.sports_complex",
            elementType: "all",
            stylers: [{
                visibility: "off",
            }, ],
        },
        {
            featureType: "transit.station.bus",
            elementType: "all",
            stylers: [{
                    visibility: "on",
                },
                {
                    saturation: "21",
                },
                {
                    weight: "4.05",
                },
            ],
        },
    ],
};
let map = new google.maps.Map(document.getElementById("map"), options); //mapにOptionsの内容を反映させる

const getLatLng = (data) => {
    data.forEach((d) => {
        // ジオコーダのコンストラクタ
        let geocoder = new google.maps.Geocoder();

        // geocodeリクエストを実行。
        // 第１引数はGeocoderRequest。住所⇒緯度経度座標の変換時はaddressプロパティを入れればOK。
        // 第２引数はコールバック関数。
        geocoder.geocode({
                address: d.address,
            },
            (results, status) => {
                if (status == google.maps.GeocoderStatus.OK) {
                    // 結果の表示範囲。結果が１つとは限らないので、LatLngBoundsで用意。
                    let bounds = new google.maps.LatLngBounds();

                    for (let i in results) {
                        if (results[i].geometry) {
                            // 緯度経度を取得
                            let latlng = results[i].geometry.location;
                            let buttonRoute = document.getElementById("button-route");
                            if (buttonRoute != undefined) {
                                buttonRoute.dataset.dest = latlng;
                                buttonRoute.classList.remove("disable");
                            }

                            // 住所を取得(日本の場合だけ「日本, 」を削除)
                            let address = results[0].formatted_address.replace(/^日本, /, "");

                            // 検索結果地が含まれるように範囲を拡大
                            bounds.extend(latlng);

                            let marker = new google.maps.Marker({
                                //ここでマーカーを打つ
                                position: latlng, //緯度経度をしていする
                                map: map, //どのマップに打つか指定する
                                title: d.comment, //メッセージをしていする
                                icon: {
                                    url: "wp_contents/image/point.png",
                                    scaledSize: new google.maps.Size(40, 40),
                                },
                            });

                            let iw = new google.maps.InfoWindow({
                                content: d.title,
                            });

                            google.maps.event.addListener(marker, "click", () => {
                                location.href = d.url;
                            });
                            google.maps.event.addListener(marker, "mouseover", () => {
                                iw.open(map, marker);
                            });
                            google.maps.event.addListener(marker, "mouseout", () => {
                                iw.close();
                            });
                        }
                    }

                    // 範囲を移動
                    map.fitBounds(bounds);
                    map.setZoom(d.zoom);
                } else {
                    alert("以下の理由で使用できませんでした" + status); //例外処理
                }
            }
        );
    });
};