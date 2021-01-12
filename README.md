{
	"total" : 1,
	"snap_token":22,
	"status_order": "success",
	"status_payments":"paid",
	"details": [
		{
			"idclass" : 1,
			"price" : 1
		}
		]
}

// accoount ekselen
MIDTRANS_MERCHANT_ID=G935902159
MIDTRANS_CLIENT_KEY=SB-Mid-client-CfYlo3Io5wEXR0Pn
MIDTRANS_SERVER_KEY=SB-Mid-server-kB0JHC85WsgKfG8l8M1YraMj

midtrans account :
admin@ekselen.id
pass: Ekselen2020

tasks
1. price di details nge get data price kelas
2. customer details : data firstname lastname dan alamat didaapat database userprofiles
3. kondisi :
        $saveOrders->status_order = 'pending';
        $saveOrders->status_payments = 'unpaid';
	- akan berubah success saat pembayaran settlement di midtrans api ekselen
	- unpaid akan berubah saat paid saat pembayaran selesai di apiekselen
4. myclass query di dapat user pembelian kelas menjadi list data pembelian
5. total orders di dapat dr jumlah price 
6. total_quantity orders di dapat quanti di details orders 
7. token orders masih belum solve 
