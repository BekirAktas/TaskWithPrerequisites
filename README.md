--READ ME--
Projenin başlatılabilmesi için ilk başta veritabanında "forwardiedb" adında bir schema oluşturulması ve .env dosyasına veritabanı bağlantı bilgilerin girilmesi gerekmektedir. Örnek:

DB_DATABASE=forwardiedb
DB_USERNAME=root
DB_PASSWORD=password

Schema oluşturulduktan sonra terminalde proje dizinine gidip:
"php artisan migrate" komutu çalıştırılıp tabloların oluşturulması gerekmektedir.
ardından
projenin başlatılması:
"php artisan serve" komutuyla proje başlatılır.

SystemController içerisinde yazılan koda ulaşabilirsiniz.

projedeki endpointlerin listesi

task oluşturma:
http://127.0.0.1:8000/api/create-task

<!-- {
    task oluşturmak için örnek json:

	"title":"task 4",
	"type":"invoice_ops",
	"amount":{
		"currency":"$",
		"quantity":1200
	}

} -->

taska prerequisite ekleme:
http://127.0.0.1:8000/api/add-prerequisite/{taskId}

taska prerequiiste eklemek için örnek json:

<!-- {
	"prerequisite_task_id":[4]
} -->

örneğin 3 numaralı taska 4 numaralı task prerequisite olarak eklenecekse:
http://127.0.0.1:8000/api/add-prerequisite/3

<!-- 
{
	"prerequisite_task_id":[4]
}
-->

bütün taskları sırasız şekilde çekilmesi için:
http://127.0.0.1:8000/api/get-all-tasks

taskları sıralı bir şekilde almak için:
http://127.0.0.1:8000/api/order-tasks
