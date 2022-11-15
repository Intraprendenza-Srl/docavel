## Error Handling

All errors follow general REST principles. Included in the body of any error response (e.g. non-200 status code) will be an error object of the form:

Parameter | Value
--------- | -------
success | The success value will be set to false
status | The HTTP error status returned
error | The detailed description of the error.
error.code | A slug/string alternative of the error code.
error.message | Message for the error.
error.fields | Available in the case of error 422.

> In the case of an error 422, a fields property will be available in the error object with the name of the affected fields as keys and an array of messages as values respectively. An example is shown below:

```json
	{
	    "status": 422,
	    "success": false,
	    "error": {
	        "code": "validation_failed",
	        "message": null,
	        "fields": {
	            "network": [
	                "The network field is required."
	            ]
	        }
	    }
	}
```

```json
	{
	    "status": 422,
	    "success": false,
	    "error": {
	        "code": "validation_failed",
	        "message": null,
	        "fields": {
	            "login": [
	                "The login field is required."
	            ]
	        }
	    }
	}
```

### This API uses the following error codes:

Error Code | Slug | Type
---------- | ---- | ----
400 | bad_request | Bad Request
401 | unauthorized | Unauthorized
403 | forbidden | Forbidden
404 | not_found | Not Found
405 | method_not_allowed | Method Not Allowed
406 | not_acceptable | Not Acceptable
410 | gone | Gone
422 | validation_failed | Unprocessible Entity
429 | too_many_requests | Too Many Requests
500 | server_error | Internal Server Error
503 | service_unavailable | Service Unavailable
