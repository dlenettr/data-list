# Data List
<img src="https://img.shields.io/badge/dle-12.1-007dad.svg"> <img src="https://img.shields.io/badge/lang-tr-ce600f.svg"> <img src="https://img.shields.io/badge/license-MIT-60ce0f.svg">

Makaleniz için ekstra alanlar oluşturup bu bilgileri farklı tabloda saklayabilirsiniz.
Modülün yapılış amacı ile ilgili bir örnek verecek olursak; Bir film veya dizi siteniz var. Film için birden fazla alternatif indirme veya izleme için URL giriyorsunuz. Bunun yanında o URL ye ait ekstra bilgiler... dil, site vb. var. Makale için bu alanlardan istediğiniz kadar ekleyip. Burada DLE'nin kendi sunduğu ilave alanları kullanınca satır satır girseniz bile farklı bir formatta gösteremeyeceğiniz için işinize yaramayacaktır. Veya bunu yapmak için ekstra olarak sistemi düzenlemeniz gerekecektir.

Yine DLE'nin ilave alanlarından ayrıldı bir nokta ise sadece `fullstory.tpl` de çalışması. Modül verileri veritabanında ayrı bir tabloda makale id'sini referans alarak tutuyor.

## Kurulum
**1)** Eklenti yönetimi panelinden zip dosyasını yükleyiniz. *Github zip paketi ile DLE'nin paket yapısı birbirine uyumlu değil. Bu nedenle zip'i çıkartarak, xml dosyası ana dizinde olacak şekilde tekrar zip yapmanız gerekmektedir*

## Konfigürasyon
Modül bir admin panele sahip değil. Çünkü yapılacak tek ayar alanları belirlemek bu da sürekli olarak yapılacak, fazla ayrıntı içeren bir işlem olmadığı için ilk sürümde es geçildi.
Ayarlamaları `engine/data/datalist.conf.php` dosyasından yapabilirsiniz.

Modül ile birlikte örnek alanlar gelecektir.
```
'url'  => [ "URL", "5" ],
'type' => [ "Type", "1", [ "" => "- Select -", "Watch" => "Watch", "Download" => "Download" ], "Watch" ],
'host' => [ "Site", "2", [ "" => "- Select -", "STREMANGO" => "STREMANGO", "OPENLOAD" => "OPENLOAD", "VSHARE" => "VSHARE", "YOUWATCH" => "YOUWATCH" ] ],
```
**url** Alan adı  ( Text input alanı )
* URL: Alan başlığı
* 5: Alan genişliği ( Toplam genişlik 11'den fazla olması durumunda alt satıra geçer )
-----
**type** Alan adı ( Select alanı )
* Type: Alan başlığı
* 1: Alan genişliği
* []: Seçenekler ( php array ), "kaydedilecek" => "gösterilecek", yapısında. 
Dizinin son elemanı "Watch" bu da varsayılan olarak seçilecek alan.

Modül kurulum ve ayarlamalarından sonra `fullstory.tpl` dosyasına eklemeler yaparak kullanmaya başlayabilirsiniz.

Satır şablonu:

`[data-row] ... [/data-row]`

Bu şablon içinde oluşturduğunuz alan adı değerlerini yukarıdaki örneğe göre:

```
{lang}
{type}
{quality}
{host}
{url}
```
olarak kullanabilirsiniz. Örnek bir kullanım:

```html
<ul>
    [data-row]
    <li>
        <b>{lang}</b> |
        <b>{type}</b> |
        <b>{quality}</b> |
        <b>{host}</b> |
        <button data-src="{url}" onclick="watch(this);return false">İzle</button>
    </li>
    [/data-row]
</ul>
```

Örnekte URL alanına girilen embed URL'leri İzle butonuna tıklayınca sabit olan iframe de oynatılmasını sağlıyoruz. Gerekli diğer kodlar arşivdeki kurulum dokümanında mevcut.

## Notlar
* Modül sadece admin panelden konu eklerken ve düzenlerken kullanılabilir.
* DLE'nin ilave alanlarından tamamen bağımsızdır.
* Veriler data_list tablosunda tutulur.
* [Link Checker](https://github.com/dlenettr/link-checker) modülü ile uyumludur. Yani `url` adında kullandığınız alanlardaki değerleri otomatik olarak kontrol ettirebilirsiniz.
    
## Ekran Görüntüleri
![Ekran 1](docs/screen1.png?raw=true)
![Ekran 2](docs/screen2.png?raw=true)
![Ekran 3](docs/screen3.png?raw=true)

## Tarihçe

| Version | Tarih | Uyumluluk | Yenilikler |
| ------- | ----- | --------- | ---------- |
| **1.1** | 19.01.2019 | 13.0+ | Yeni DLE sürümleri ile uyumluluk. Eklenti haline getirildi. |
| **1.0** | 06.03.2018 | 12.0, 12.1|İlk sürüm.|