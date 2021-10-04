window.onload = () => {

    const getLatLng = () => {
        // ジオコーダのコンストラクタ
        let place = document.getElementById("address").value;  // 住所を記憶する変数
        let message = document.getElementById("coment").value; // コメントを記憶する変数
        let geocoder = new google.maps.Geocoder();

        // geocodeリクエストを実行。
        // 第１引数はGeocoderRequest。住所⇒緯度経度座標の変換時はaddressプロパティを入れればOK。
        // 第２引数はコールバック関数。
        geocoder.geocode({
            address: place
        }, (results, status) => {
            if(status == google.maps.GeocoderStatus.OK) {
                // 結果の表示範囲。結果が１つとは限らないので、LatLngBoundsで用意。
                let bounds = new google.maps.LatLngBounds();

                for(let i in results) {
                    if(results[i].geometry) {

                        // 緯度経度を取得
                        let latlng = results[i].geometry.location;

                        // 住所を取得(日本の場合だけ「日本, 」を削除)
                        let address = results[0].formatted_address.replace(/^日本, /, "");

                        // 検索結果地が含まれるように範囲を拡大
                        bounds.extend(latlng);

                        // あとはご自由に・・・。
                        new google.maps.InfoWindow({
                            content: address + "<br>(Lat, Lng) = " + latlng.toString()
                        }).open(map, new google.maps.Marker({   // ここでマーカーを打つ
                            position: latlng,                   // 緯度経度をしていする
                            map: map,                           // どのマップに打つか指定する
                            title: message                      // メッセージを指定する
                        }));
                    }
                }

                // 範囲を移動
                map.fitBounds(bounds);
            } else {
                alert("以下の理由で使用できませんでした\n" + status);//例外処理
            }
        });
    }

    // let btn = document.getElementById("addressbtn");
    // btn.onclick = () => getLatLng();

    let myLatLng = new google.maps.LatLng(35.6811673, 139.7670516); // 初期の中心座標を決める変数
    let options = {             // 初期状態を定める変数
        zoom: 15,               // 初期状態の地図の縮尺値
        center: myLatLng,       // 指定した変数の値を初期状態の地図の中心座標にする
        mapTypeId: "roadmap"    // 初期状態の地図の種類
    };
    let map = new google.maps.Map(document.getElementById("map"), options); // mapにoptionsの内容を反映させる

}