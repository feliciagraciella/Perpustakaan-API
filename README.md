
# Perpustakaan API

API for Perpustakaan apps



## API Reference

### Get book list

```http
  GET /api/books
```

### Get book detail

```http
  GET /api/books/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `Int` | **Required**. Id of item to fetch |

### Get loan list

```http
  GET /api/loans
```

### Get loan detail

```http
  GET /api/loans/{id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `Int` | **Required**. Id of item to fetch |

### Create new loan

```http
  POST /api/newloan
```

#### Request Body
Accept: application/json


| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `details`      | `array` | **Required**. An array of loan details (array of bookID) |
| `bookID`      | `integer` | **Required**. The ID of the book to be loaned. |
| `memberID`      | `integer` | **Required**. The ID of the member taking the loan. |

Example

```
{
  "details": [
    {"bookID": 1},
    {"bookID": 2}
  ],
  "memberID": 123
}
```

### Update Loan (Book Return)

```
PUT /api/books/return/{loanID}/{bookID}
```
| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `loanID`      | `integer` | **Required**. The ID of the loan |
| `bookID`      | `integer` | **Required**. The ID of the book to be returned |

### Get member list
```
PUT /api/members
```


### Create new member
```
POST /api/members/create
```
#### Request Body
Accept: application/json


| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `memberName`      | `string` | **Required**. Name of the new member |

Example

```
{
  "memberName": "John Doe"
}
```






