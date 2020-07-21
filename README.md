# Neighbour to Neighbour Api End points

###Server Address : http://homemadefoodpro.com/

#### User Registration 

method `POST`

end point: ```/api/register``` 

Json:
```angular2
{
    "first_name":"John",
    "last_name":"Doe",
    "phone_number" : "03137845392",
    "email":"john.doe@example.com",
    "password":"12345678",

}
```

Response:
```angular2
{
    "data": "User Registered successfully"
}
```

### User Login

end point: `/api/login `

method  `POST`

json:
```
 {
  	
  	"email": "zainarshad@innowi.com",
  	"password": "12345678"
  }
```

Response:
```
{
    
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjZkZTkwZmIxZGMyZGNmYWY5ZTJjMzgxMDhhNTE2YWQ3N2FjNWIwYzk5MzQ5NjY0ZmU2ZGM3NWQyYmZjZDVhNjBjZWZmOWU2NDVhNTdmZmUyIn0.eyJhdWQiOiIyIiwianRpIjoiNmRlOTBmYjFkYzJkY2ZhZjllMmMzODEwOGE1MTZhZDc3YWM1YjBjOTkzNDk2NjRmZTZkYzc1ZDJiZmNkNWE2MGNlZmY5ZTY0NWE1N2ZmZTIiLCJpYXQiOjE1NTc3NDY3NjksIm5iZiI6MTU1Nzc0Njc2OSwiZXhwIjoxNTg5MzY5MTY5LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.gActUIuKfqpYlM87qlx3EnbJcRt3zXR2wpOxo-J50qDzcaserNW1Hfd3KJ5fjtNg8q6o6alH8r5rr-J9HjBwRdFMYz3f15LjMxDhqBoF7-W8IXqOxV5eKxfveseWzwfiBtkErOJv4uNZ1PdVmPhgeOjxS9BHRDImppFc5o72ioQL4DrPHOawZr7PiSN509xWlckH7tHufon79ghAksNPn_JbhXvHQdFc4Ugw0JYp4T8HhHGcjy9iPTpbXq8ktDOe0Mkf7eb-iBS7NX-VnGNc_TrZ0Efz0N8_VNUV1HB9zIku_l2lQia8Crdv1appKqNKUAcYvmRke05hAAjCtJQqXMtJBUuOmjFOJGAXV1fFyO0LgzoPaJ-9C0b0YQCLL-WR7TzliuZrgtindz81eb165b48bFPCddQ-Uy4JtsmMOfEOV8fESeJ20H1x4Lr-3q6ASbV1R6NnKRoF2McZoUn33JpgA5qWFQvShyk-KnE2rQhKHnrl8wk0qk1SA--PM2Jhi2euwBRVMscxMYmhtQ0nXlaZSlcZFhNz8YNIW0cxR-92D-DMO_EHe5TEFr6gbJtv7Cs2z7OSL7yGEKP6hAPO0O0rm_ZNayLWQyiYN0uAJKAkAScOfV-SRNl-TE7VzCLI6bqQyC94Okr7SNq3M6eH0MCLb_920TZw0XAPPmr-YX4",
    "refresh_token": "def502004ac94b9d6d418b14ae75ef4f1e362346fa49c6ea848698eed7c04af051f068485783af47a755e0ded32920ac7e1927ce2f071c98b48ddd2139414c7d9f4c916580e80bcf3c3ad4cbb7459d4f4cc18576b1300c2d73fcd65e89dbf75d1d79e4b4ccebf1a0507e0b65d46dbeaa8ab6fdda0e6adee8b26fd556e03b465d1c54f1b90114727b39da79e997daf0636b133b6bafcf4f0fef11ffb37e9a4f747138876b72e1b564559062af83c2db541cf8da03e4babe22a479a0ef84d17c47bf617178b31ac447177ef3f3535ec467a33cc9f58b1272b8e356d4b6b23c390b86f878d25f12c0b4943a3ce55c2a08711bde1aba13c48f7364feb178048a1d344b5418688a8ebb19e995d62eea34c281cf42a22b15fba1d547197a0df537a751b6eef3962e78e3aecec8e3ee4f323568c47f74b6e477de5b1c4093c5f7b600b3e5b16108828241696bd73d21ccd2ea19e10003083155b49d6897773ba81c18b0a9"
}
```
#### Get User 

method `GET`

end point: ```/api/user``` 

Response:
```angular2

    "user": {
        "id": 7,
        "email": "zainarshad45888@gmail.com",
        "email_verified_at": null,
        "created_at": "2019-12-22 13:54:04",
        "updated_at": "2019-12-22 13:55:24",
        "first_name": "Zain",
        "last_name": "Arsgad",
        "image": null,
        "phone_number": "1234567",
        "date_of_birth": null,
        "role": "2",
        "gender": null
    }

```

#### GET User Detail 

method `GET`

end point: ```/api/user/data``` 

Response:
```angular2

    {
    "user":     {
                    "id": 5,
                    "name": "piiza",
                    "price": "1500",
                    "serving_size": "large",
                    "cuisine_type": "abcd",
                    "dietary_information": "xsxjhjskdhcbsd",
                    "course_type": "abcd",
                    "description": "sxsdxsada",
                    "chef_id": 4,
                    "created_at": "2020-01-15 16:36:19",
                    "updated_at": "2020-01-22 09:58:22",
                    "ingredients": [
                        {
                            "ingredients": "sdcds"
                        }
                    ],
                    "servingtime": [
                        {
                            "servingtime": "lunch"
                        }
                    ],
                    "dishimages": [
                        {
                            "id": 5,
                            "dishimages": "http://127.0.0.1:8000/img/dishes/IMG_0063.JPG"
                        }
                    ],
                    "total_reviews": 2,
                    "average_rating": "5.0000",
                    "reviews": [
                        {
                            "rating": 5,
                            "comments": "comments for dish id 1"
                        },
                        {
                            "rating": 5,
                            "comments": "comments for dish id 1"
                        }
                    ]
                }
}

```

#### Chef Register

method `POST`

end point: ```/api/chef/register``` 

Json:
```angular2
{
    "business_name": "Monal",
	"business_email": "zain@gmail.com",
    "business_phone": "12345678",
    "business_image": imageFile,
    "experience": 2,
    "city": "Lahore",
    "state": "Punjab",
    "postal_code": "44000",
    "chef_description" : "sadadasax asdad asd",
    "pickup_location" : "Pin Location",
    "awards[]": "award1",
    "awards[]": "award2",
    "cuisines[]": "Pakistani",
    "cuisines[]": "Chinese",

}
```

Response:
```angular2

    "user": {
        Chef Registered Successfully
    }

```

#### GET CHEF 

method `GET`

end point: ```/api/chef``` 

Response:
```angular2

    {
    "chef": {
        "id": 19,
        "business_name": "Business",
        "business_email": "business112@gmail.com",
        "business_phone": "business phone",
        "pickup_location": "Gujrat",
        "city": "Gujrat",
        "state": "Punjab",
        "business_image": "http://homemadefoodpro.com/img/chefs/download.jpg",
        "postal_code": "44000",
        "experience": "2.00",
        "chef_description": "description",
        "user_id": "9",
        "created_at": "2019-12-31 08:52:56",
        "updated_at": "2019-12-31 09:23:22"
    },
    "awards": [
        {
            "award": "ggg"
        },
        {
            "award": "ggg"
        }
    ],
    "cuisines": [
        {
            "cuisine": "zuuu"
        },
        {
            "cuisine": "uuuuz"
        },
        {
            "cuisine": "hghg"
        }
    ]
}

```

#### Chef Update

method `PUT`

end point: ```/api/chef/update``` 

Json:
```angular2
{
    "business_name": "Monal",
	"business_email": "zain@gmail.com",
    "business_phone": "12345678",
    "experience": 2,
    "city": "Lahore",
    "state": "Punjab",
    "postal_code": "44000",
    "chef_description" : "sadadasax asdad asd",
    "pickup_location" : "Pin Location",
    "awards[]": "award1",
    "awards[]": "award2",
    "cuisines[]": "Pakistani",
    "cuisines[]": "Chinese",

}
```

Response:
```angular2

    "user": {
        Chef Updated Successfully
    }

```

#### Chef Image Update

method `POST`

end point: ```/api/chef/update/image``` 

Json:
```angular2
{
    "business_name": imageFile,
}
```

Response:
```angular2

    "user": {
        Image Updated Successfully
    }

```

### Get Chef by Cuisines

method `POST`

end point: ```/api/chef/cuisine``` 

Json:
```angular2
{
    “cuisine": pakistani
}
```

Response:
```angular2

    "chefs": [
        {
            "id": "3",
            "business_name": "koi b naam",
            "business_email": "busines@gmail.com",
            "business_phone": "090078601",
            "pickup_location": "pin location",
            "city": "lahore",
            "state": "punjab",
            "business_image": "http://homemadefoodpro.com/img/chefs/IMG_0063.JPG",
            "postal_code": "4422",
            "experience": "2.00",
            "user_id": "3",
            "created_at": "2020-01-14 12:35:15",
            "updated_at": "2020-01-14 12:44:30",
            "chef_description": "abcd efgh ijkl"
        }
        ]

```
### Get Cuisines by chef ID

method `GET`

end point: ```/api/chef/cuisine/{chef_id}``` 

Response:
```angular2

     "cuisines": [
        {
            "id": "7",
            "cuisine": "pakistani",
            "chef_id": "3",
            "created_at": "2020-01-14 12:44:30",
            "updated_at": "2020-01-14 12:44:30"
        }
    ]

```
### Add Chef Review

method `POST`

end point: ```/api/chefreview``` 

Json:
```angular2
{
    “rating": 5,
    "comments":abcd efgh,
    "chef_id":2
}
```

Response:
```angular2

    "message": [
        {
            "id": "3",
            "rating": "5",
            "comments": "abcd efgh",
            "chef_id": "2",
            "created_at": "2020-01-14 12:35:15",
            "updated_at": "2020-01-14 12:44:30"
        }
        ]

```
### Get Chef Reviews

method `GET`

end point: ```/api/chefreviews``` 


Response:
```angular2

   "reviews": [
        {
            "id": 1,
            "created_at": "2020-01-16 14:44:57",
            "updated_at": "2020-01-16 14:44:57",
            "rating": 5,
            "comments": "abcd efjhbjkn bjhbjhk",
            "chef_id": 1,
            "user_id": 4
        }
        ]

```
### Get Chef Detail

method `GET`

end point: ```/api/chefdetail``` 


Response:
```angular2
"chef": [
        {
            "id": 1,
            "business_name": "Test Chef",
            "business_email": "andromedatechnologies@gmail.com",
            "business_phone": "090078601",
            "pickup_location": "islamabad",
            "city": "islamabad",
            "state": "punjab",
            "business_image": "http://127.0.0.1:8000/img/chefs/Capture.PNG",
            "postal_code": "1233",
            "experience": 2,
            "user_id": 2,
            "created_at": "2020-01-10 16:00:28",
            "updated_at": "2020-01-24 11:17:54",
            "chef_description": "abcdefghhjk",
            "isVerified": 0,
            "isBlocked": 1,
            "awards": [
                {
                    "award": "abcd"
                }
            ],
            "cuisines": [
                {
                    "cuisine": "abcd"
                }
            ]
        }
        ]

```
### Add Chef Report

method `POST`

end point: ```/api/chef/report``` 

Json:
```angular2
{
    “report_reason": abcd efgh,
    "chef_id":2
}
```

Response:
```angular2

{
    "message": "Report sent successfully"
}
```
### Get Chef all data

method `GET`

end point: ```/api/data``` 


Response:
```angular2
{ 
    "chef": [
                {
                    "id": 5,
                    "name": "piiza",
                    "price": "1500",
                    "serving_size": "large",
                    "cuisine_type": "abcd",
                    "dietary_information": "xsxjhjskdhcbsd",
                    "course_type": "abcd",
                    "description": "sxsdxsada",
                    "chef_id": 4,
                    "created_at": "2020-01-15 16:36:19",
                    "updated_at": "2020-01-22 09:58:22",
                    "ingredients": [
                        {
                            "ingredients": "sdcds"
                        }
                    ],
                    "servingtime": [
                        {
                            "servingtime": "lunch"
                        }
                    ],
                    "dishimages": [
                        {
                            "id": 5,
                            "dishimages": "http://127.0.0.1:8000/img/dishes/IMG_0063.JPG"
                        }
                    ],
                    "total_reviews": 3,
                    "average_rating": "5.0000",
                    "reviews": [
                        {
                            "rating": 5,
                            "comments": "comments for dish id 1"
                        },
                        {
                            "rating": 5,
                            "comments": "comments for dish id 1"
                        },
                        {
                            "rating": 5,
                            "comments": "comments for dish id 5"
                        }
                    ] 
                 }
         ]
}

```
#### Add Dish

method `POST`

end point: ```/api/dish``` 

Json:
```angular2
{
    “name": pizza,
    “price”: 1500,
    “serving_size”: large,
    “cusine_type”: abc,
    “dietary_information”: abcd efgh ijkl,
    “course_type”: abcd,
    “description”: abcdbvhhgjas,
    "halal":1,
    “ingredients”: abcd[],
    “dishimages”: imageFile[],
    “serving_time”: lunch
}
```

Response:
```angular2

    "message": {
        Dishes added Successfully
    }

```

#### Get Dishes

method `GET`

end point: ```/api/dishes``` 

Response:
```angular2

    "dish": {
            "id": 1,
            "name": "abcd",
            "price": "250",
            "serving_size": "12",
            "cusine_type": "abc",
            "dietary_information": "abcdefghijklmnopqrstuvwxyz",
            "course_type": "abc",
            "description": "abcdefghijklmnopqrstuvwxyz",
            "halal": "1",
            "chef_id": 1,
            "created_at": "2020-01-02 01:46:20",
            "updated_at": "2020-01-02 04:59:51",
            "ingredients": [
                {
                    "ingredients": "abcd"
                },
                {
                    "ingredients": "abcd"
                }
        ],
            "servingtime": [
                {
                    "servingtime": "lunch"
                }
                ],
            "dishimages": [
                {
                    "id": 1,
                    "dishimages": "http://127.0.0.1:8000/img/dishes/bnana.jpg"
                },
                {
                    "id": 2,
                    "dishimages": "E:\\xampp\\tmp\\php5B13.tmp"
                }
            ],
            "reviews": [
                {
                    "rating": 2,
                    "comments": "abcde"
                }
            ]
        }


```
#### Dish Update

method `PUT`

end point: ```/api/dish/update``` 

Json:
```angular2
{
    “id”: 1,
    “name": pizza,
    “price”: 1500,
    “serving_size”: large,
    “cusine_type”: abc,
    “dietary_information”: abcd efgh ijkl,
    “course_type”: abcd,
    “description”: abcdbvhhgjas,
    "halal":1,
    “ingredients”: abcd[],
    “serving_time”: lunch[]
}
```

Response:
```angular2

    "dish": {
        Dish record updated successfully
    }

```


#### Dish Image Update

method `POST`

end point: ```/api/dish/update/image``` 

Json:
```angular2
{
    "dishimages": imageFile,
}
```

Response:
```angular2

{
    "dish": "http://homemadefoodpro.com/img/dishes/background.jpg"
}

```
#### Dish Delete

method `DELETE`

end point: ```/api/dish/delete/{id}``` 

Response:
```angular2

    "dish": {
        Dish deleted Successfully
    }

```
### Get Dish through ID

method `GET`

end point: ```/api/dish/{id}``` 

Response:
```angular2

   "dish": {
            "id": 1,
            "name": "abcd",
            "price": "250",
            "serving_size": "12",
            "cusine_type": "abc",
            "dietary_information": "abcdefghijklmnopqrstuvwxyz",
            "course_type": "abc",
            "description": "abcdefghijklmnopqrstuvwxyz",
            "halal":"1",
            "chef_id": 1,
            "created_at": "2020-01-02 01:46:20",
            "updated_at": "2020-01-02 04:59:51",
            "ingredients": [
                {
                    "ingredients": "abcd"
                },
                {
                    "ingredients": "abcd"
                }
        ],
            "servingtime": [
                {
                    "servingtime": "lunch"
                }
            ],
            "dishimages": [
                {
                    "id": 1,
                    "dishimages": "http://127.0.0.1:8000/img/dishes/bnana.jpg"
                },
                {
                    "id": 2,
                    "dishimages": "http://127.0.0.1:8000/img/dishes/bnana.jpg"
                }
            ],
            "reviews": [
                {
                    "rating": 2,
                    "comments": "abcde"
                }
            ]
        }

```
### Filter Dish by Cuisines

method `POST`

end point: ```/api/dish/cuisine``` 

Json:
```angular2
{
    "cuisine_type": xxx,
}
```

Response:
```angular2

{
      "dish": [
        {
            "id": 3,
            "name": "xxxx",
            "price": "120",
            "serving_size": "xxxx",
            "cuisine_type": "xxx",
            "dietary_information": "dbchsbcjefbgwejf",
            "course_type": "jhh",
            "description": "bcdgcvhgcvdhscfvhsgcfh",
            "halal":"1",
            "chef_id": 4,
            "created_at": "2020-01-11 08:15:56",
            "updated_at": "2020-01-11 10:12:02"
        }
    ]
}

```
### Filter dishes by Cuisine

method `GET`

end point: ```/api/dish/cuisine/{cuisine}``` 

Response:
```angular2

{
      "dish": [
        {
            "id": 3,
            "name": "xxxx",
            "price": "120",
            "serving_size": "xxxx",
            "cuisine_type": "xxx",
            "dietary_information": "dbchsbcjefbgwejf",
            "course_type": "jhh",
            "description": "bcdgcvhgcvdhscfvhsgcfh",
            "halal": "1",
            "chef_id": 4,
            "created_at": "2020-01-11 08:15:56",
            "updated_at": "2020-01-11 10:12:02"
        }
    ]
}

```
### Filter dish by price

method `POST`

end point: ```/api/dish/price``` 

Json:
```angular2
{
    "min": 1200,
    "max":2000
}
```

Response:
```angular2

{
      "dishes": [
        {
            "id": 3,
            "name": "xxxx",
            "price": "1200",
            "serving_size": "xxxx",
            "cuisine_type": "xxx",
            "dietary_information": "dbchsbcjefbgwejf",
            "course_type": "jhh",
            "description": "bcdgcvhgcvdhscfvhsgcfh",
            "halal": "1",
            "chef_id": 4,
            "created_at": "2020-01-11 08:15:56",
            "updated_at": "2020-01-11 10:12:02"
        }
    ]
}

```
### Get Dish Detail

method `GET`

end point: ```/api/dishdetail``` 

Response:
```angular2

{
      "dish": [
         {
            "id": 5,
            "name": "piiza",
            "price": "1500",
            "serving_size": "large",
            "cuisine_type": "abcd",
            "dietary_information": "xsxjhjskdhcbsd",
            "course_type": "abcd",
            "description": "sxsdxsada",
            "halal": "1",
            "chef_id": 4,
            "created_at": "2020-01-15 16:36:19",
            "updated_at": "2020-01-22 09:58:22",
            "ingredients": [
                {
                    "ingredients": "sdcds"
                }
            ],
            "servingtime": [
                {
                    "servingtime": "lunch"
                }
            ],
            "dishimage": [
                {
                    "id": 5,
                    "dishimages": "http://127.0.0.1:8000/img/dishes/IMG_0063.JPG"
                }
            ],
            "reviews": [
                {
                    "rating": 5,
                    "comments": "comments for dish id 1"
                },
                {
                    "rating": 5,
                    "comments": "comments for dish id 1"
                }
            ]
        }
    ]
}

```
### Add Dish Review 

method `POST`

end point: ```/api/review``` 

Json:
```angular2
{
    "rating": 5,
    "comments":comments for dish id 5,
    "dish_id":5
}
```

Response:
```angular2

{
       "message": {
        "rating": "5",
        "comments": "comments for dish id 5",
        "dish_id": "5",
        "user_id": 4,
        "updated_at": "2020-01-27 13:06:41",
        "created_at": "2020-01-27 13:06:41",
        "id": 22
    }
}

```
### Get Dish Review 

method `GET`

end point: ```/api/reviews``` 

Response:
```angular2

{
     "reviews": [
        {
            "id": 20,
            "rating": 5,
            "comments": "comments for dish id 1",
            "dish_id": 5,
            "user_id": 4,
            "created_at": "2020-01-17 10:15:17",
            "updated_at": "2020-01-17 10:15:17"
        }
    ]
}

```
### Filter by Cuisine and Price

method `POST`

end point: ```/api/cuisineprice``` 

Json:
```angular2
{
    "min": 100,
    "max": 150,
    "cuisine_type":xxx
}
```

Response:
```angular2

{
    "dish": [
        {
            "id": 3,
            "name": "xxxx",
            "price": "120",
            "serving_size": "xxxx",
            "cuisine_type": "xxx",
            "dietary_information": "dbchsbcjefbgwejf",
            "course_type": "jhh",
            "description": "bcdgcvhgcvdhscfvhsgcfh",
            "halal": "1",
            "chef_id": 4,
            "created_at": "2020-01-11 08:15:56",
            "updated_at": "2020-01-11 10:12:02"
        }
    ]
}
```

