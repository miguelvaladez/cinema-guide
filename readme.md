# Cinema-Guide Laravel App
RESTful API built in Laravel 5, allows for mobile and web based services to access cinema guide listings meeting the following requirements:

- Responds to application/media type and returns data in JSON format
- Retrieves listing of movies playing at a given cinema on a given date
- Cinema listing supports pagination
- Supports partial date search
- Includes documentation

**Note:** All routes have a prefix of 'api/v1'

## Data Responses
Successful data responses are paginated (limited to 5 items per page) and repeat the following structure:
```json
{
	"total": 21,
	"per_page": 5,
	"current_page": 1,
	"last_page": 5,
	"next_page_url": "http://localhost/api/v1/movies/?page=2",
	"prev_page_url": null,
	"from": 1,
	"to": 5,
	"data": []
}
```
Or will return as:
```json
{
	"type" : "success/failure",
	"message": "message here"
}
```

## Cinemas
Cinema data is returned as follows:
```json
{
	"id": "1",
	"name": "Cinema Lynch",
	"address": "81402 Hilpert Shoals Suite 758\nLake Eldon, CA 06039",
	"latitude": "-22.253077",
	"longitude": "-66.454326"
}
```

## Movies
Movie data is returned as follows:
```json
{
	"id": "1",
	"title": "Sunt illo in."
}
```

## Session Times
Session times are retrieved with their related movie and cinema data:
```json
{
	"id": "1",
	"movie_id": "1",
	"cinema_id": "1",
	"session_time": "2015-08-16 13:46:33",
	"cinema": {
		"id": "1",
		"name": "Cinema Lynch",
		"address": "81402 Hilpert Shoals Suite 758\nLake Eldon, CA 06039",
		"latitude": "-22.253077",
		"longitude": "-66.454326"
	},
	"movie": {
		"id": "1",
		"title": "Sunt illo in."
	}
}
```
