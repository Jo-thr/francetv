---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://api.localhost/docs/collection.json)

<!-- END_INFO -->

#Heading


Get heading collection
<!-- START_6e725b9f51fcd9becb1edaffffe0ee12 -->
## Get heading collection

> Example request:

```bash
curl -X GET \
    -G "https://api.localhost/api/headings" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://api.localhost/api/headings"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": "infos",
            "type": "headings",
            "lang": "fr",
            "data": {
                "label": "Informations",
                "slug": "infos"
            },
            "meta": {
                "slug": {
                    "fr": "infos",
                    "en": "news"
                }
            }
        },
        {
            "id": "podcasts",
            "type": "headings",
            "lang": "fr",
            "data": {
                "label": "Podcasts",
                "slug": "podcasts"
            },
            "meta": {
                "slug": {
                    "fr": "podcasts",
                    "en": "podcasts"
                }
            }
        },
        {
            "id": "tutos",
            "type": "headings",
            "lang": "fr",
            "data": {
                "label": "Tutoriels",
                "slug": "tutos"
            },
            "meta": {
                "slug": {
                    "fr": "tutos",
                    "en": "tutorials"
                }
            }
        },
        {
            "id": "recherche-narrative",
            "type": "headings",
            "lang": "fr",
            "data": {
                "label": "StoryLab",
                "slug": "recherche-narrative"
            },
            "meta": {
                "slug": {
                    "fr": "recherche-narrative",
                    "en": "narrative-research"
                }
            }
        },
        {
            "id": "startups",
            "type": "headings",
            "lang": "fr",
            "data": {
                "label": "Start-ups",
                "slug": "startups"
            },
            "meta": {
                "slug": {
                    "fr": "startups",
                    "en": "startups"
                }
            }
        },
        {
            "id": "transformation",
            "type": "headings",
            "lang": "fr",
            "data": {
                "label": "Transformation",
                "slug": "transformation"
            },
            "meta": {
                "slug": {
                    "fr": "transformation",
                    "en": "transformation"
                }
            }
        }
    ]
}
```

### HTTP Request
`GET api/headings`


<!-- END_6e725b9f51fcd9becb1edaffffe0ee12 -->

#Layout


Get one layout
<!-- START_58d792e6aa703a8a24ff72e5b071d514 -->
## Get one layout by name

> Example request:

```bash
curl -X GET \
    -G "https://api.localhost/api/layouts/quo?lang=numquam" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://api.localhost/api/layouts/quo"
);

let params = {
    "lang": "numquam",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": "8d144d10-bcb5-481c-b9e6-937210c6573b",
    "type": "layouts",
    "lang": "fr",
    "data": {
        "name": "podcasts",
        "description": "description en français",
        "title": "",
        "color": null,
        "underline": "#FFFFFF",
        "font_black": true,
        "primary": {
            "featured": {
                "id": "8203b712-cd51-46d5-8d17-90caf251c3a4",
                "type": "posts",
                "lang": "fr",
                "external": null,
                "slug": "rerum-quas-mollitia-accusamus-totam-nulla-in-ipsum",
                "data": {
                    "title": "Eaque unde ex aliquam ipsa.",
                    "content": "",
                    "featured": "featured.png",
                    "url": null,
                    "heading": "podcasts",
                    "published_at": "2020-09-11T00:00:00.000000Z",
                    "created_at": "2020-09-11T09:39:18.000000Z",
                    "updated_at": "2020-09-11T09:39:18.000000Z"
                },
                "author": {
                    "name": "Gérard Leconte",
                    "departement": ""
                },
                "meta": {
                    "slug": {
                        "en": "sit-maxime-nisi-quia",
                        "fr": "rerum-quas-mollitia-accusamus-totam-nulla-in-ipsum"
                    }
                }
            },
            "featuredimg": "test.jpg",
            "featuredimgalt": "Quidem tenetur enim sed."
        },
        "secondary": {
            "block2": {
                "id": "81a253a8-9b3c-48f5-8f03-f6316c700fe4",
                "type": "posts",
                "lang": "fr",
                "external": null,
                "slug": "et-ut-earum-veritatis-consectetur",
                "data": {
                    "title": "Aut quaerat sed dignissimos beatae sunt commodi iusto.",
                    "content": "",
                    "featured": "featured.png",
                    "url": null,
                    "heading": "podcasts",
                    "published_at": "2020-09-11T00:00:00.000000Z",
                    "created_at": "2020-09-11T09:39:18.000000Z",
                    "updated_at": "2020-09-11T09:39:18.000000Z"
                },
                "author": {
                    "name": "Bernadette Poirier",
                    "departement": ""
                },
                "meta": {
                    "slug": {
                        "en": "debitis-sed-pariatur-hic-mollitia",
                        "fr": "et-ut-earum-veritatis-consectetur"
                    }
                }
            },
            "block3": {
                "id": "a8f42333-343e-4d27-ac03-0a178ae1a09e",
                "type": "posts",
                "lang": "fr",
                "external": null,
                "slug": "quae-eos-sed-maiores-distinctio-nisi",
                "data": {
                    "title": "Beatae nam voluptatem enim id.",
                    "content": "",
                    "featured": "featured.png",
                    "url": null,
                    "heading": "podcasts",
                    "published_at": "2020-09-11T00:00:00.000000Z",
                    "created_at": "2020-09-11T09:39:18.000000Z",
                    "updated_at": "2020-09-11T09:39:18.000000Z"
                },
                "author": {
                    "name": "Lucas David",
                    "departement": ""
                },
                "meta": {
                    "slug": {
                        "en": "qui-vitae-porro-eveniet",
                        "fr": "quae-eos-sed-maiores-distinctio-nisi"
                    }
                }
            }
        }
    }
}
```

### HTTP Request
`GET api/layouts/{name}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `name` |  required  | The Name of the Layout
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `lang` |  optional  | To get the Layout translated

<!-- END_58d792e6aa703a8a24ff72e5b071d514 -->

<!-- START_c84b7558b512936c30094365adc2cc15 -->
## Get layout collection

> Example request:

```bash
curl -X GET \
    -G "https://api.localhost/api/layouts" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://api.localhost/api/layouts"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": "8d5db731-cdf9-41db-aa08-c9a40dc9f170",
            "type": "layouts",
            "lang": "fr",
            "data": {
                "name": "meta-medias",
                "description": "",
                "title": "",
                "color": null,
                "underline": "#FF778B",
                "font_black": false,
                "primary": {
                    "featured": {
                        "id": "504d234f-0726-49c4-a118-8334263c4ae7",
                        "type": "meta-medias",
                        "position": 11,
                        "lang": "fr",
                        "data": {
                            "title": "Modi totam optio dolorum hic quae perspiciatis est minus.",
                            "url": "http:\/\/bailly.com\/qui-corporis-ipsum-maxime-distinctio",
                            "image": "https:\/\/www.meta-media.fr\/files\/2020\/08\/illustration2.jpg",
                            "description": "Aliquam asperiores harum ut quia doloremque voluptatem non. Aspernatur enim dolorum laboriosam. Similique ullam nesciunt sapiente illo ducimus quo et. Perferendis inventore harum aut est.",
                            "published_at": "2020-09-11T09:39:16.000000Z",
                            "created_at": "2020-09-11T09:39:16.000000Z",
                            "updated_at": "2020-09-11T09:39:16.000000Z"
                        }
                    },
                    "featuredimg": "test.jpg",
                    "featuredimgalt": "Aut enim maxime maxime."
                },
                "secondary": {
                    "block2": {
                        "id": "4b105917-9235-4670-99de-38293dcac320",
                        "type": "meta-medias",
                        "position": 33,
                        "lang": "fr",
                        "data": {
                            "title": "Commodi nostrum recusandae facere iure maxime qui ipsa.",
                            "url": "https:\/\/www.remy.org\/eum-perferendis-ut-iure-nihil-omnis-et-omnis-corporis",
                            "image": "https:\/\/www.meta-media.fr\/files\/2020\/08\/illustration2.jpg",
                            "description": "Ad et voluptas dolorem consectetur. Et sit fuga sapiente consectetur mollitia quisquam officia.",
                            "published_at": "2020-09-11T09:39:16.000000Z",
                            "created_at": "2020-09-11T09:39:17.000000Z",
                            "updated_at": "2020-09-11T09:39:17.000000Z"
                        }
                    },
                    "block3": {
                        "id": "346e5dba-178b-4446-b38c-f4c0d0dbce2a",
                        "type": "meta-medias",
                        "position": 48,
                        "lang": "fr",
                        "data": {
                            "title": "Consequatur modi corrupti excepturi quam quo.",
                            "url": "http:\/\/bertin.fr\/incidunt-sed-aspernatur-explicabo-id-qui.html",
                            "image": "https:\/\/www.meta-media.fr\/files\/2020\/08\/illustration2.jpg",
                            "description": "Temporibus aspernatur facere architecto esse. Voluptates sunt est magnam hic ad dolore. Error recusandae ut suscipit et voluptas ducimus ad consectetur.",
                            "published_at": "2020-09-11T09:39:16.000000Z",
                            "created_at": "2020-09-11T09:39:17.000000Z",
                            "updated_at": "2020-09-11T09:39:17.000000Z"
                        }
                    }
                }
            }
        },
        {
            "id": "f045e615-44bd-4d6f-9244-0821ff0fe7e5",
            "type": "layouts",
            "lang": "fr",
            "data": {
                "name": "home",
                "description": "",
                "title": "",
                "color": null,
                "underline": "#FFFFFF",
                "font_black": true,
                "primary": {
                    "featured": {
                        "id": "f9d231bd-d9a5-45bb-8eed-0da39c079fed",
                        "type": "posts",
                        "lang": "fr",
                        "external": null,
                        "slug": "atque-aperiam-dolorum-provident-dolore-porro-voluptas-maiores-quo",
                        "data": {
                            "title": "Nulla iste molestiae voluptatem quibusdam.",
                            "content": "",
                            "featured": "featured.png",
                            "url": null,
                            "heading": "transformation",
                            "published_at": "2020-09-11T00:00:00.000000Z",
                            "created_at": "2020-09-11T09:39:20.000000Z",
                            "updated_at": "2020-09-11T09:39:20.000000Z"
                        },
                        "author": {
                            "name": "Catherine Brunel",
                            "departement": ""
                        },
                        "meta": {
                            "slug": {
                                "en": "placeat-nam-ratione-voluptates",
                                "fr": "atque-aperiam-dolorum-provident-dolore-porro-voluptas-maiores-quo"
                            }
                        }
                    },
                    "featuredimg": "test.jpg",
                    "featuredimgalt": "Sequi nemo dolor facilis."
                },
                "secondary": {
                    "block2": {
                        "id": "a8f42333-343e-4d27-ac03-0a178ae1a09e",
                        "type": "posts",
                        "lang": "fr",
                        "external": null,
                        "slug": "quae-eos-sed-maiores-distinctio-nisi",
                        "data": {
                            "title": "Beatae nam voluptatem enim id.",
                            "content": "",
                            "featured": "featured.png",
                            "url": null,
                            "heading": "podcasts",
                            "published_at": "2020-09-11T00:00:00.000000Z",
                            "created_at": "2020-09-11T09:39:18.000000Z",
                            "updated_at": "2020-09-11T09:39:18.000000Z"
                        },
                        "author": {
                            "name": "Lucas David",
                            "departement": ""
                        },
                        "meta": {
                            "slug": {
                                "en": "qui-vitae-porro-eveniet",
                                "fr": "quae-eos-sed-maiores-distinctio-nisi"
                            }
                        }
                    },
                    "block3": {
                        "id": "57a97e80-7d5f-4035-a547-23d0f47901c0",
                        "type": "posts",
                        "lang": "fr",
                        "external": null,
                        "slug": "in-rerum-et-repudiandae-illo-quas-est-iste",
                        "data": {
                            "title": "Qui soluta omnis ut ut.",
                            "content": "",
                            "featured": "featured.png",
                            "url": null,
                            "heading": "tutos",
                            "published_at": "2020-09-11T00:00:00.000000Z",
                            "created_at": "2020-09-11T09:39:18.000000Z",
                            "updated_at": "2020-09-11T09:39:18.000000Z"
                        },
                        "author": {
                            "name": "Anastasie Jean",
                            "departement": ""
                        },
                        "meta": {
                            "slug": {
                                "en": "in-magnam-facere-possimus",
                                "fr": "in-rerum-et-repudiandae-illo-quas-est-iste"
                            }
                        }
                    }
                }
            }
        },
        {
            "id": "8211a39f-fa50-45ce-956c-3c3e900d0111",
            "type": "layouts",
            "lang": "fr",
            "data": {
                "name": "infos",
                "description": "description en français",
                "title": "",
                "color": null,
                "underline": "#FFFFFF",
                "font_black": true,
                "primary": {
                    "featured": {
                        "id": "eb60683d-b97f-4a2e-90c7-78af9c55547e",
                        "type": "posts",
                        "lang": "fr",
                        "external": null,
                        "slug": "sed-tempora-numquam-porro-itaque-iste-eaque",
                        "data": {
                            "title": "Amet nobis dolores quisquam modi neque corporis id.",
                            "content": "",
                            "featured": "featured.png",
                            "url": null,
                            "heading": "infos",
                            "published_at": "2020-09-11T00:00:00.000000Z",
                            "created_at": "2020-09-11T09:39:17.000000Z",
                            "updated_at": "2020-09-11T09:39:17.000000Z"
                        },
                        "author": {
                            "name": "Adélaïde Charrier",
                            "departement": ""
                        },
                        "meta": {
                            "slug": {
                                "en": "voluptatem-quo-quo-quod-et-beatae-veniam",
                                "fr": "sed-tempora-numquam-porro-itaque-iste-eaque"
                            }
                        }
                    },
                    "featuredimg": "test.jpg",
                    "featuredimgalt": "Vitae quidem natus est atque."
                },
                "secondary": {
                    "block2": {
                        "id": "2b4c2c69-2a20-4586-bffa-7f449d85e534",
                        "type": "posts",
                        "lang": "fr",
                        "external": null,
                        "slug": "magnam-accusamus-recusandae-commodi-magni",
                        "data": {
                            "title": "Eius eligendi impedit quisquam id dolorum.",
                            "content": "",
                            "featured": "featured.png",
                            "url": null,
                            "heading": "infos",
                            "published_at": "2020-09-11T00:00:00.000000Z",
                            "created_at": "2020-09-11T09:39:17.000000Z",
                            "updated_at": "2020-09-11T09:39:17.000000Z"
                        },
                        "author": {
                            "name": "Maggie Chauvet",
                            "departement": ""
                        },
                        "meta": {
                            "slug": {
                                "en": "vel-quisquam-dolor-rerum-repudiandae-quam-illo",
                                "fr": "magnam-accusamus-recusandae-commodi-magni"
                            }
                        }
                    },
                    "block3": {
                        "id": "af8bd910-3e0f-4493-b8c1-0004d0adfaea",
                        "type": "posts",
                        "lang": "fr",
                        "external": null,
                        "slug": "nam-error-ratione-saepe-consequatur-facilis",
                        "data": {
                            "title": "Molestiae et fuga fuga molestias.",
                            "content": "",
                            "featured": "featured.png",
                            "url": null,
                            "heading": "infos",
                            "published_at": "2020-09-11T00:00:00.000000Z",
                            "created_at": "2020-09-11T09:39:17.000000Z",
                            "updated_at": "2020-09-11T09:39:17.000000Z"
                        },
                        "author": {
                            "name": "Lucas David",
                            "departement": ""
                        },
                        "meta": {
                            "slug": {
                                "en": "sint-fugiat-iste-minus-quo-error-alias-quis-quis",
                                "fr": "nam-error-ratione-saepe-consequatur-facilis"
                            }
                        }
                    }
                }
            }
        },
        {
            "id": "8d144d10-bcb5-481c-b9e6-937210c6573b",
            "type": "layouts",
            "lang": "fr",
            "data": {
                "name": "podcasts",
                "description": "description en français",
                "title": "",
                "color": null,
                "underline": "#FFFFFF",
                "font_black": true,
                "primary": {
                    "featured": {
                        "id": "8203b712-cd51-46d5-8d17-90caf251c3a4",
                        "type": "posts",
                        "lang": "fr",
                        "external": null,
                        "slug": "rerum-quas-mollitia-accusamus-totam-nulla-in-ipsum",
                        "data": {
                            "title": "Eaque unde ex aliquam ipsa.",
                            "content": "",
                            "featured": "featured.png",
                            "url": null,
                            "heading": "podcasts",
                            "published_at": "2020-09-11T00:00:00.000000Z",
                            "created_at": "2020-09-11T09:39:18.000000Z",
                            "updated_at": "2020-09-11T09:39:18.000000Z"
                        },
                        "author": {
                            "name": "Gérard Leconte",
                            "departement": ""
                        },
                        "meta": {
                            "slug": {
                                "en": "sit-maxime-nisi-quia",
                                "fr": "rerum-quas-mollitia-accusamus-totam-nulla-in-ipsum"
                            }
                        }
                    },
                    "featuredimg": "test.jpg",
                    "featuredimgalt": "Quidem tenetur enim sed."
                },
                "secondary": {
                    "block2": {
                        "id": "81a253a8-9b3c-48f5-8f03-f6316c700fe4",
                        "type": "posts",
                        "lang": "fr",
                        "external": null,
                        "slug": "et-ut-earum-veritatis-consectetur",
                        "data": {
                            "title": "Aut quaerat sed dignissimos beatae sunt commodi iusto.",
                            "content": "",
                            "featured": "featured.png",
                            "url": null,
                            "heading": "podcasts",
                            "published_at": "2020-09-11T00:00:00.000000Z",
                            "created_at": "2020-09-11T09:39:18.000000Z",
                            "updated_at": "2020-09-11T09:39:18.000000Z"
                        },
                        "author": {
                            "name": "Bernadette Poirier",
                            "departement": ""
                        },
                        "meta": {
                            "slug": {
                                "en": "debitis-sed-pariatur-hic-mollitia",
                                "fr": "et-ut-earum-veritatis-consectetur"
                            }
                        }
                    },
                    "block3": {
                        "id": "a8f42333-343e-4d27-ac03-0a178ae1a09e",
                        "type": "posts",
                        "lang": "fr",
                        "external": null,
                        "slug": "quae-eos-sed-maiores-distinctio-nisi",
                        "data": {
                            "title": "Beatae nam voluptatem enim id.",
                            "content": "",
                            "featured": "featured.png",
                            "url": null,
                            "heading": "podcasts",
                            "published_at": "2020-09-11T00:00:00.000000Z",
                            "created_at": "2020-09-11T09:39:18.000000Z",
                            "updated_at": "2020-09-11T09:39:18.000000Z"
                        },
                        "author": {
                            "name": "Lucas David",
                            "departement": ""
                        },
                        "meta": {
                            "slug": {
                                "en": "qui-vitae-porro-eveniet",
                                "fr": "quae-eos-sed-maiores-distinctio-nisi"
                            }
                        }
                    }
                }
            }
        },
        {
            "id": "325e79ea-1577-4f50-beb4-ca94702d9748",
            "type": "layouts",
            "lang": "fr",
            "data": {
                "name": "tutos",
                "description": "description en français",
                "title": "",
                "color": null,
                "underline": "#FFFFFF",
                "font_black": true,
                "primary": {
                    "featured": {
                        "id": "870cdc14-99fc-4779-b9ac-8669e25c0d66",
                        "type": "posts",
                        "lang": "fr",
                        "external": null,
                        "slug": "fuga-quo-sint-odit-provident-aut-a-qui",
                        "data": {
                            "title": "Laboriosam ipsum vel dignissimos autem.",
                            "content": "",
                            "featured": "featured.png",
                            "url": null,
                            "heading": "tutos",
                            "published_at": "2020-09-11T00:00:00.000000Z",
                            "created_at": "2020-09-11T09:39:18.000000Z",
                            "updated_at": "2020-09-11T09:39:18.000000Z"
                        },
                        "author": {
                            "name": "Jules Olivier",
                            "departement": ""
                        },
                        "meta": {
                            "slug": {
                                "en": "provident-odit-voluptatum-ullam",
                                "fr": "fuga-quo-sint-odit-provident-aut-a-qui"
                            }
                        }
                    },
                    "featuredimg": "test.jpg",
                    "featuredimgalt": "Provident et enim vero dolor."
                },
                "secondary": {
                    "block2": {
                        "id": "870cdc14-99fc-4779-b9ac-8669e25c0d66",
                        "type": "posts",
                        "lang": "fr",
                        "external": null,
                        "slug": "fuga-quo-sint-odit-provident-aut-a-qui",
                        "data": {
                            "title": "Laboriosam ipsum vel dignissimos autem.",
                            "content": "",
                            "featured": "featured.png",
                            "url": null,
                            "heading": "tutos",
                            "published_at": "2020-09-11T00:00:00.000000Z",
                            "created_at": "2020-09-11T09:39:18.000000Z",
                            "updated_at": "2020-09-11T09:39:18.000000Z"
                        },
                        "author": {
                            "name": "Jules Olivier",
                            "departement": ""
                        },
                        "meta": {
                            "slug": {
                                "en": "provident-odit-voluptatum-ullam",
                                "fr": "fuga-quo-sint-odit-provident-aut-a-qui"
                            }
                        }
                    },
                    "block3": {
                        "id": "57a97e80-7d5f-4035-a547-23d0f47901c0",
                        "type": "posts",
                        "lang": "fr",
                        "external": null,
                        "slug": "in-rerum-et-repudiandae-illo-quas-est-iste",
                        "data": {
                            "title": "Qui soluta omnis ut ut.",
                            "content": "",
                            "featured": "featured.png",
                            "url": null,
                            "heading": "tutos",
                            "published_at": "2020-09-11T00:00:00.000000Z",
                            "created_at": "2020-09-11T09:39:18.000000Z",
                            "updated_at": "2020-09-11T09:39:18.000000Z"
                        },
                        "author": {
                            "name": "Anastasie Jean",
                            "departement": ""
                        },
                        "meta": {
                            "slug": {
                                "en": "in-magnam-facere-possimus",
                                "fr": "in-rerum-et-repudiandae-illo-quas-est-iste"
                            }
                        }
                    }
                }
            }
        },
        {
            "id": "414790ae-5b08-4542-ab16-7db8c0c1bae5",
            "type": "layouts",
            "lang": "fr",
            "data": {
                "name": "recherche-narrative",
                "description": "description en français",
                "title": "",
                "color": null,
                "underline": "#FFFFFF",
                "font_black": true,
                "primary": {
                    "featured": {
                        "id": "4f41144c-71de-487a-8775-b04eeb4bc8a7",
                        "type": "posts",
                        "lang": "fr",
                        "external": null,
                        "slug": "sed-vel-est-voluptatibus-voluptatem-quia-dolorem",
                        "data": {
                            "title": "Laborum illum laborum maxime totam.",
                            "content": "",
                            "featured": "featured.png",
                            "url": null,
                            "heading": "recherche-narrative",
                            "published_at": "2020-09-11T00:00:00.000000Z",
                            "created_at": "2020-09-11T09:39:19.000000Z",
                            "updated_at": "2020-09-11T09:39:19.000000Z"
                        },
                        "author": {
                            "name": "Nicolas Jacob",
                            "departement": ""
                        },
                        "meta": {
                            "slug": {
                                "en": "quia-dolore-alias-qui-ut-provident-accusamus",
                                "fr": "sed-vel-est-voluptatibus-voluptatem-quia-dolorem"
                            }
                        }
                    },
                    "featuredimg": "test.jpg",
                    "featuredimgalt": "Minima voluptatem iusto et."
                },
                "secondary": {
                    "block2": {
                        "id": "548a8a64-d6b2-4b79-93b5-05aa5c249fec",
                        "type": "posts",
                        "lang": "fr",
                        "external": null,
                        "slug": "eveniet-est-ipsam-vel-occaecati-quibusdam-aspernatur",
                        "data": {
                            "title": "Dignissimos vel rerum ut fugit accusantium corrupti.",
                            "content": "",
                            "featured": "featured.png",
                            "url": null,
                            "heading": "recherche-narrative",
                            "published_at": "2020-09-11T00:00:00.000000Z",
                            "created_at": "2020-09-11T09:39:19.000000Z",
                            "updated_at": "2020-09-11T09:39:19.000000Z"
                        },
                        "author": {
                            "name": "Xavier Perrot",
                            "departement": ""
                        },
                        "meta": {
                            "slug": {
                                "en": "quia-expedita-iste-veritatis-deleniti-optio-aut-omnis",
                                "fr": "eveniet-est-ipsam-vel-occaecati-quibusdam-aspernatur"
                            }
                        }
                    },
                    "block3": {
                        "id": "bde41258-3c24-4c7a-8f18-6e85aadb6401",
                        "type": "posts",
                        "lang": "fr",
                        "external": null,
                        "slug": "quae-et-corrupti-aut-et-facilis",
                        "data": {
                            "title": "Sed ipsa voluptatem totam.",
                            "content": "",
                            "featured": "featured.png",
                            "url": null,
                            "heading": "recherche-narrative",
                            "published_at": "2020-09-11T00:00:00.000000Z",
                            "created_at": "2020-09-11T09:39:19.000000Z",
                            "updated_at": "2020-09-11T09:39:19.000000Z"
                        },
                        "author": {
                            "name": "Lucas David",
                            "departement": ""
                        },
                        "meta": {
                            "slug": {
                                "en": "velit-voluptates-voluptas-dicta-ut-ut-et-quaerat",
                                "fr": "quae-et-corrupti-aut-et-facilis"
                            }
                        }
                    }
                }
            }
        },
        {
            "id": "ff1d186d-f06d-4f1a-81fb-68cf41a0e963",
            "type": "layouts",
            "lang": "fr",
            "data": {
                "name": "startups",
                "description": "description en français",
                "title": "",
                "color": null,
                "underline": "#FFFFFF",
                "font_black": true,
                "primary": {
                    "featured": {
                        "id": "093378ba-882d-4e54-ab20-6d753ecb0599",
                        "type": "posts",
                        "lang": "fr",
                        "external": null,
                        "slug": "est-officia-officia-quia-sequi-ab-sed-quod-et",
                        "data": {
                            "title": "Iusto velit ducimus itaque numquam.",
                            "content": "",
                            "featured": "featured.png",
                            "url": null,
                            "heading": "startups",
                            "published_at": "2020-09-11T00:00:00.000000Z",
                            "created_at": "2020-09-11T09:39:19.000000Z",
                            "updated_at": "2020-09-11T09:39:19.000000Z"
                        },
                        "author": {
                            "name": "Robert Gros",
                            "departement": ""
                        },
                        "meta": {
                            "slug": {
                                "en": "sunt-maxime-libero-recusandae-nam-optio-possimus-sed-sapiente",
                                "fr": "est-officia-officia-quia-sequi-ab-sed-quod-et"
                            }
                        }
                    },
                    "featuredimg": "test.jpg",
                    "featuredimgalt": "Minima velit optio pariatur."
                },
                "secondary": {
                    "block2": {
                        "id": "5f07761e-7950-46e8-bc28-fff3eef13c09",
                        "type": "posts",
                        "lang": "fr",
                        "external": null,
                        "slug": "quo-corrupti-quod-vitae-asperiores",
                        "data": {
                            "title": "Soluta qui velit fuga et accusamus quis a.",
                            "content": "",
                            "featured": "featured.png",
                            "url": null,
                            "heading": "startups",
                            "published_at": "2020-09-11T00:00:00.000000Z",
                            "created_at": "2020-09-11T09:39:19.000000Z",
                            "updated_at": "2020-09-11T09:39:19.000000Z"
                        },
                        "author": {
                            "name": "Claudine Goncalves",
                            "departement": ""
                        },
                        "meta": {
                            "slug": {
                                "en": "aliquam-architecto-velit-officia-consequatur",
                                "fr": "quo-corrupti-quod-vitae-asperiores"
                            }
                        }
                    },
                    "block3": {
                        "id": "9aa7e94d-c252-4abf-a288-a452fdef655c",
                        "type": "posts",
                        "lang": "fr",
                        "external": null,
                        "slug": "non-reprehenderit-esse-laboriosam",
                        "data": {
                            "title": "Maxime inventore et porro sapiente voluptas.",
                            "content": "",
                            "featured": "featured.png",
                            "url": null,
                            "heading": "startups",
                            "published_at": "2020-09-11T00:00:00.000000Z",
                            "created_at": "2020-09-11T09:39:19.000000Z",
                            "updated_at": "2020-09-11T09:39:19.000000Z"
                        },
                        "author": {
                            "name": "Laurent Roussel",
                            "departement": ""
                        },
                        "meta": {
                            "slug": {
                                "en": "aliquam-et-eos-ipsa-suscipit",
                                "fr": "non-reprehenderit-esse-laboriosam"
                            }
                        }
                    }
                }
            }
        },
        {
            "id": "99c8f0fa-8cc8-4792-9b4f-3510ad496456",
            "type": "layouts",
            "lang": "fr",
            "data": {
                "name": "transformation",
                "description": "description en français",
                "title": "",
                "color": null,
                "underline": "#FFFFFF",
                "font_black": true,
                "primary": {
                    "featured": {
                        "id": "a4bfd8a7-4b63-4f8e-92e2-e3166bfa9403",
                        "type": "posts",
                        "lang": "fr",
                        "external": null,
                        "slug": "qui-iste-natus-et",
                        "data": {
                            "title": "Delectus qui eum quia dolorem sint velit.",
                            "content": "",
                            "featured": "featured.png",
                            "url": null,
                            "heading": "transformation",
                            "published_at": "2020-09-11T00:00:00.000000Z",
                            "created_at": "2020-09-11T09:39:20.000000Z",
                            "updated_at": "2020-09-11T09:39:20.000000Z"
                        },
                        "author": {
                            "name": "Alexandrie Potier",
                            "departement": ""
                        },
                        "meta": {
                            "slug": {
                                "en": "fugit-rerum-velit-quibusdam-voluptatem-in-pariatur",
                                "fr": "qui-iste-natus-et"
                            }
                        }
                    },
                    "featuredimg": "test.jpg",
                    "featuredimgalt": "A aliquam amet quod qui."
                },
                "secondary": {
                    "block2": {
                        "id": "9ffc5264-6bc7-4f7d-90ce-3bd9891f287e",
                        "type": "posts",
                        "lang": "fr",
                        "external": null,
                        "slug": "quos-et-at-impedit-voluptatum-blanditiis-corporis-voluptatem-et",
                        "data": {
                            "title": "Deleniti nostrum saepe aut eaque.",
                            "content": "",
                            "featured": "featured.png",
                            "url": null,
                            "heading": "transformation",
                            "published_at": "2020-09-11T00:00:00.000000Z",
                            "created_at": "2020-09-11T09:39:20.000000Z",
                            "updated_at": "2020-09-11T09:39:20.000000Z"
                        },
                        "author": {
                            "name": "Alexandrie Potier",
                            "departement": ""
                        },
                        "meta": {
                            "slug": {
                                "en": "quo-officiis-blanditiis-quas-aut-dolorem",
                                "fr": "quos-et-at-impedit-voluptatum-blanditiis-corporis-voluptatem-et"
                            }
                        }
                    },
                    "block3": {
                        "id": "ebf87dc1-caaf-4878-9a2d-0200ce818576",
                        "type": "posts",
                        "lang": "fr",
                        "external": null,
                        "slug": "mollitia-voluptatem-aut-harum-illum-itaque",
                        "data": {
                            "title": "Nulla esse autem temporibus dolore ipsam reprehenderit.",
                            "content": "",
                            "featured": "featured.png",
                            "url": null,
                            "heading": "transformation",
                            "published_at": "2020-09-11T00:00:00.000000Z",
                            "created_at": "2020-09-11T09:39:20.000000Z",
                            "updated_at": "2020-09-11T09:39:20.000000Z"
                        },
                        "author": {
                            "name": "Théodore Gilbert",
                            "departement": ""
                        },
                        "meta": {
                            "slug": {
                                "en": "voluptas-hic-accusamus-reprehenderit-facilis-aspernatur-dolorem-quod",
                                "fr": "mollitia-voluptatem-aut-harum-illum-itaque"
                            }
                        }
                    }
                }
            }
        }
    ]
}
```

### HTTP Request
`GET api/layouts`


<!-- END_c84b7558b512936c30094365adc2cc15 -->

#MetaMedia


Get metamedia collection
<!-- START_af2ed559576be38c5a689c1efa805c19 -->
## Get MetaMedia collection

> Example request:

```bash
curl -X GET \
    -G "https://api.localhost/api/meta-medias?page=ut&sort%3Dpublished_at=molestias&sort%3D-published_at=et" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://api.localhost/api/meta-medias"
);

let params = {
    "page": "ut",
    "sort=published_at": "molestias",
    "sort=-published_at": "et",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": "70405a2f-e616-4ab3-8a3f-c970e03957ce",
            "type": "meta-medias",
            "position": 1,
            "lang": "fr",
            "data": {
                "title": "Nesciunt saepe qui qui sunt natus culpa quidem.",
                "url": "http:\/\/herve.net\/nostrum-qui-quisquam-totam-deleniti-cum-consequatur-quis.html",
                "image": "https:\/\/www.meta-media.fr\/files\/2020\/08\/illustration2.jpg",
                "description": "Alias aliquam aut cumque necessitatibus. Veniam veniam odio beatae at illo. Voluptates reiciendis repellendus qui ea dolorem ut id. Ut corporis voluptas odio repudiandae reprehenderit mollitia odit.",
                "published_at": "2020-09-10T11:18:25.000000Z",
                "created_at": "2020-09-10T11:18:25.000000Z",
                "updated_at": "2020-09-10T11:18:25.000000Z"
            }
        },
        {
            "id": "146316e1-c93f-450a-a394-1064f4a1be2f",
            "type": "meta-medias",
            "position": 2,
            "lang": "fr",
            "data": {
                "title": "Quasi sed voluptas eius dolorem architecto.",
                "url": "https:\/\/bodin.org\/eum-officia-ea-est-laboriosam.html",
                "image": "https:\/\/www.meta-media.fr\/files\/2020\/08\/illustration2.jpg",
                "description": "Id voluptas magni in. Numquam quisquam maxime consequatur ut qui ut dolores eum. Est rerum quisquam et aperiam.",
                "published_at": "2020-09-10T11:18:25.000000Z",
                "created_at": "2020-09-10T11:18:25.000000Z",
                "updated_at": "2020-09-10T11:18:25.000000Z"
            }
        }
    ],
    "links": {
        "first": "http:\/\/api.localhost\/api\/meta-medias?page=1",
        "last": "http:\/\/api.localhost\/api\/meta-medias?page=4",
        "prev": null,
        "next": "http:\/\/api.localhost\/api\/meta-medias?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 4,
        "path": "http:\/\/api.localhost\/api\/meta-medias",
        "per_page": 15,
        "to": 15,
        "total": 50
    }
}
```

### HTTP Request
`GET api/meta-medias`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `page` |  optional  | For pagination
    `sort=published_at` |  optional  | Sort by published date
    `sort=-published_at` |  optional  | Sort by published date inverses

<!-- END_af2ed559576be38c5a689c1efa805c19 -->

#Post


Get posts collection
<!-- START_da50450f1df5336c2a14a7a368c5fb9c -->
## Return posts collection, paginated

> Example request:

```bash
curl -X GET \
    -G "https://api.localhost/api/posts?filter[type]=facere&sort%3Dpublished_at=voluptatem&sort%3D-published_at=aut&page=animi" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://api.localhost/api/posts"
);

let params = {
    "filter[type]": "facere",
    "sort=published_at": "voluptatem",
    "sort=-published_at": "aut",
    "page": "animi",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": "f7da94cb-b22a-410e-b6af-7ac6b365fd9f",
            "type": "posts",
            "lang": "fr",
            "external": true,
            "slug": "voluptatem-beatae-et-doloremque-maiores",
            "data": {
                "title": "Sint quia eveniet maxime. Consequatur aut et amet optio.",
                "content": "",
                "featured": "featured.png",
                "url": null,
                "heading": "infos",
                "published_at": "2020-09-10T00:00:00.000000Z",
                "created_at": "2020-09-10T11:18:26.000000Z",
                "updated_at": "2020-09-10T11:18:26.000000Z"
            },
            "author": {
                "name": "Maurice Vallee",
                "departement": ""
            },
            "meta": {
                "slug": {
                    "en": "accusantium-nesciunt-voluptate-nesciunt-fugiat-est-animi-fugit-quia",
                    "fr": "voluptatem-beatae-et-doloremque-maiores"
                }
            }
        },
        {
            "id": "73d2d23a-1266-4907-8b4a-6248f4dd4622",
            "type": "posts",
            "lang": "fr",
            "external": true,
            "slug": "culpa-voluptas-veniam-qui-est",
            "data": {
                "title": "Libero omnis deserunt architecto. Et eaque eaque neque.",
                "content": "",
                "featured": "featured.png",
                "url": null,
                "heading": "infos",
                "published_at": "2020-09-10T00:00:00.000000Z",
                "created_at": "2020-09-10T11:18:26.000000Z",
                "updated_at": "2020-09-10T11:18:26.000000Z"
            },
            "author": {
                "name": "Charlotte Guichard",
                "departement": ""
            },
            "meta": {
                "slug": {
                    "en": "odio-quo-aliquid-pariatur-odio-qui-dolorem",
                    "fr": "culpa-voluptas-veniam-qui-est"
                }
            }
        }
    ],
    "links": {
        "first": "http:\/\/api.localhost\/api\/posts?page=1",
        "last": "http:\/\/api.localhost\/api\/posts?page=5",
        "prev": null,
        "next": "http:\/\/api.localhost\/api\/posts?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 5,
        "path": "http:\/\/api.localhost\/api\/posts",
        "per_page": 15,
        "to": 15,
        "total": 61
    }
}
```

### HTTP Request
`GET api/posts`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `filter[type]` |  optional  | Filter by type
    `sort=published_at` |  optional  | Sort by published date
    `sort=-published_at` |  optional  | Sort by published date inverses
    `page` |  optional  | For pagination

<!-- END_da50450f1df5336c2a14a7a368c5fb9c -->

<!-- START_1dd91e499fb47f7d894c646878958e26 -->
## Get one post by slug

> Example request:

```bash
curl -X GET \
    -G "https://api.localhost/api/posts/voluptate?lang=ut&page=perspiciatis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://api.localhost/api/posts/voluptate"
);

let params = {
    "lang": "ut",
    "page": "perspiciatis",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": "f7da94cb-b22a-410e-b6af-7ac6b365fd9f",
    "type": "posts",
    "lang": "fr",
    "external": true,
    "slug": "voluptatem-beatae-et-doloremque-maiores",
    "data": {
        "title": "Sint quia eveniet maxime. Consequatur aut et amet optio.",
        "content": "",
        "featured": "featured.png",
        "url": null,
        "heading": "infos",
        "published_at": "2020-09-10T00:00:00.000000Z",
        "created_at": "2020-09-10T11:18:26.000000Z",
        "updated_at": "2020-09-10T11:18:26.000000Z"
    },
    "author": {
        "name": "Maurice Vallee",
        "departement": ""
    },
    "meta": {
        "slug": {
            "en": "accusantium-nesciunt-voluptate-nesciunt-fugiat-est-animi-fugit-quia",
            "fr": "voluptatem-beatae-et-doloremque-maiores"
        }
    }
}
```

### HTTP Request
`GET api/posts/{slug}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `slug` |  required  | The Slug of the Post
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `lang` |  optional  | To get the Post translated
    `page` |  optional  | For pagination

<!-- END_1dd91e499fb47f7d894c646878958e26 -->

<!-- START_ab9c3c1bd1797b14d9eb5f1d2b36a6bf -->
## Get posts by tag, paginated

> Example request:

```bash
curl -X GET \
    -G "https://api.localhost/api/tags/1/posts?lang=ut&page=quasi" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://api.localhost/api/tags/1/posts"
);

let params = {
    "lang": "ut",
    "page": "quasi",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": "f7da94cb-b22a-410e-b6af-7ac6b365fd9f",
            "type": "posts",
            "lang": "fr",
            "external": true,
            "slug": "voluptatem-beatae-et-doloremque-maiores",
            "data": {
                "title": "Sint quia eveniet maxime. Consequatur aut et amet optio.",
                "content": "",
                "featured": "featured.png",
                "url": null,
                "heading": "infos",
                "published_at": "2020-09-10T00:00:00.000000Z",
                "created_at": "2020-09-10T11:18:26.000000Z",
                "updated_at": "2020-09-10T11:18:26.000000Z"
            },
            "author": {
                "name": "Maurice Vallee",
                "departement": ""
            },
            "meta": {
                "slug": {
                    "en": "accusantium-nesciunt-voluptate-nesciunt-fugiat-est-animi-fugit-quia",
                    "fr": "voluptatem-beatae-et-doloremque-maiores"
                }
            }
        },
        {
            "id": "73d2d23a-1266-4907-8b4a-6248f4dd4622",
            "type": "posts",
            "lang": "fr",
            "external": true,
            "slug": "culpa-voluptas-veniam-qui-est",
            "data": {
                "title": "Libero omnis deserunt architecto. Et eaque eaque neque.",
                "content": "",
                "featured": "featured.png",
                "url": null,
                "heading": "infos",
                "published_at": "2020-09-10T00:00:00.000000Z",
                "created_at": "2020-09-10T11:18:26.000000Z",
                "updated_at": "2020-09-10T11:18:26.000000Z"
            },
            "author": {
                "name": "Charlotte Guichard",
                "departement": ""
            },
            "meta": {
                "slug": {
                    "en": "odio-quo-aliquid-pariatur-odio-qui-dolorem",
                    "fr": "culpa-voluptas-veniam-qui-est"
                }
            }
        }
    ],
    "links": {
        "first": "http:\/\/api.localhost\/api\/posts?page=1",
        "last": "http:\/\/api.localhost\/api\/posts?page=5",
        "prev": null,
        "next": "http:\/\/api.localhost\/api\/posts?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 5,
        "path": "http:\/\/api.localhost\/api\/posts",
        "per_page": 15,
        "to": 15,
        "total": 61
    }
}
```

### HTTP Request
`GET api/tags/{slug}/posts`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `tag` |  required  | 
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `lang` |  optional  | To get the Posts translated
    `page` |  optional  | For pagination

<!-- END_ab9c3c1bd1797b14d9eb5f1d2b36a6bf -->

<!-- START_04c7f8bf0db4c80de1e88005a8bf614c -->
## Get posts by heading, paginated

> Example request:

```bash
curl -X GET \
    -G "https://api.localhost/api/headings/1/posts?lang=et&page=totam" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://api.localhost/api/headings/1/posts"
);

let params = {
    "lang": "et",
    "page": "totam",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": "f7da94cb-b22a-410e-b6af-7ac6b365fd9f",
            "type": "posts",
            "lang": "fr",
            "external": true,
            "slug": "voluptatem-beatae-et-doloremque-maiores",
            "data": {
                "title": "Sint quia eveniet maxime. Consequatur aut et amet optio.",
                "content": "",
                "featured": "featured.png",
                "url": null,
                "heading": "infos",
                "published_at": "2020-09-10T00:00:00.000000Z",
                "created_at": "2020-09-10T11:18:26.000000Z",
                "updated_at": "2020-09-10T11:18:26.000000Z"
            },
            "author": {
                "name": "Maurice Vallee",
                "departement": ""
            },
            "meta": {
                "slug": {
                    "en": "accusantium-nesciunt-voluptate-nesciunt-fugiat-est-animi-fugit-quia",
                    "fr": "voluptatem-beatae-et-doloremque-maiores"
                }
            }
        },
        {
            "id": "73d2d23a-1266-4907-8b4a-6248f4dd4622",
            "type": "posts",
            "lang": "fr",
            "external": true,
            "slug": "culpa-voluptas-veniam-qui-est",
            "data": {
                "title": "Libero omnis deserunt architecto. Et eaque eaque neque.",
                "content": "",
                "featured": "featured.png",
                "url": null,
                "heading": "infos",
                "published_at": "2020-09-10T00:00:00.000000Z",
                "created_at": "2020-09-10T11:18:26.000000Z",
                "updated_at": "2020-09-10T11:18:26.000000Z"
            },
            "author": {
                "name": "Charlotte Guichard",
                "departement": ""
            },
            "meta": {
                "slug": {
                    "en": "odio-quo-aliquid-pariatur-odio-qui-dolorem",
                    "fr": "culpa-voluptas-veniam-qui-est"
                }
            }
        }
    ],
    "links": {
        "first": "http:\/\/api.localhost\/api\/posts?page=1",
        "last": "http:\/\/api.localhost\/api\/posts?page=5",
        "prev": null,
        "next": "http:\/\/api.localhost\/api\/posts?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 5,
        "path": "http:\/\/api.localhost\/api\/posts",
        "per_page": 15,
        "to": 15,
        "total": 61
    }
}
```

### HTTP Request
`GET api/headings/{slug}/posts`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `heading` |  required  | 
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `lang` |  optional  | To get the Posts translated
    `page` |  optional  | For pagination

<!-- END_04c7f8bf0db4c80de1e88005a8bf614c -->

#Tag


Get tag collection
<!-- START_dde6989ab5551d4fb09439f7cb2554c5 -->
## Get tag collection, paginated

> Example request:

```bash
curl -X GET \
    -G "https://api.localhost/api/tags?lang=quo&page=deleniti&sort%3Dname=laboriosam&sort%3D-name=consectetur" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://api.localhost/api/tags"
);

let params = {
    "lang": "quo",
    "page": "deleniti",
    "sort=name": "laboriosam",
    "sort=-name": "consectetur",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": "6f186d67-945e-4143-810b-ba827467c14f",
            "type": "tags",
            "lang": "fr",
            "data": {
                "name": "vallee131",
                "slug": "descamps109",
                "created_at": "2020-09-10T11:18:26.000000Z",
                "updated_at": "2020-09-10T11:18:26.000000Z"
            },
            "meta": {
                "slug": {
                    "en": "lemoine984",
                    "fr": "descamps109"
                }
            }
        },
        {
            "id": "5c7aaa0b-fbaa-4c11-a0e1-29212558e3b9",
            "type": "tags",
            "lang": "fr",
            "data": {
                "name": "berthelot456",
                "slug": "bailly245",
                "created_at": "2020-09-10T11:18:26.000000Z",
                "updated_at": "2020-09-10T11:18:26.000000Z"
            },
            "meta": {
                "slug": {
                    "en": "dacosta392",
                    "fr": "bailly245"
                }
            }
        }
    ],
    "links": {
        "first": "http:\/\/api.localhost\/api\/tags?page=1",
        "last": "http:\/\/api.localhost\/api\/tags?page=6",
        "prev": null,
        "next": "http:\/\/api.localhost\/api\/tags?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 6,
        "path": "http:\/\/api.localhost\/api\/tags",
        "per_page": 15,
        "to": 15,
        "total": 80
    }
}
```

### HTTP Request
`GET api/tags`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `heading` |  required  | 
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `lang` |  optional  | To get the Tags translated
    `page` |  optional  | For pagination
    `sort=name` |  optional  | Sort by name
    `sort=-name` |  optional  | Sort by name, inverse

<!-- END_dde6989ab5551d4fb09439f7cb2554c5 -->

#Test


Get one test
<!-- START_9f152dd22c501df3a93e3adebdeb44ce -->
## Get one test by name

> Example request:

```bash
curl -X GET \
    -G "https://api.localhost/api/tests/assumenda?lang=quisquam" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://api.localhost/api/tests/assumenda"
);

let params = {
    "lang": "quisquam",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "id": "5e416a2d-1560-47d7-a501-91724f0887d7",
    "type": "tests",
    "lang": "fr",
    "data": {
        "title": "Nemo nemo magni quia inventore. Sit velit recusandae ad.",
        "slug": "iusto-minima-quo-deleniti-excepturi-eaque-hic-sit-est",
        "content": "filler",
        "status": "open"
    },
    "meta": {
        "slug": {
            "fr": "iusto-minima-quo-deleniti-excepturi-eaque-hic-sit-est",
            "en": "illum-harum-quaerat-harum-incidunt"
        }
    }
}
```

### HTTP Request
`GET api/tests/{slug}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `slug` |  required  | The Slug of the Test
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `lang` |  optional  | To get the Test translated

<!-- END_9f152dd22c501df3a93e3adebdeb44ce -->

<!-- START_0146dc46bd47800ad95c740ae782432c -->
## Get Test collection, paginated

> Example request:

```bash
curl -X GET \
    -G "https://api.localhost/api/tests?page=eum" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://api.localhost/api/tests"
);

let params = {
    "page": "eum",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "id": "4442cd18-f35e-446c-b024-3d8959ae2a85",
            "type": "tests",
            "lang": "fr",
            "data": {
                "title": "Minus officia dolores est omnis dolorem cupiditate non.",
                "slug": "in-modi-accusamus-at-eveniet",
                "content": "filler",
                "status": "open"
            },
            "meta": {
                "slug": {
                    "fr": "in-modi-accusamus-at-eveniet",
                    "en": "dicta-quia-est-est-sequi-deleniti-doloremque-voluptatibus-nisi"
                }
            }
        },
        {
            "id": "5e416a2d-1560-47d7-a501-91724f0887d7",
            "type": "tests",
            "lang": "fr",
            "data": {
                "title": "Nemo nemo magni quia inventore. Sit velit recusandae ad.",
                "slug": "iusto-minima-quo-deleniti-excepturi-eaque-hic-sit-est",
                "content": "filler",
                "status": "open"
            },
            "meta": {
                "slug": {
                    "fr": "iusto-minima-quo-deleniti-excepturi-eaque-hic-sit-est",
                    "en": "illum-harum-quaerat-harum-incidunt"
                }
            }
        }
    ],
    "links": {
        "first": "http:\/\/api.localhost\/api\/tests?page=1",
        "last": "http:\/\/api.localhost\/api\/tests?page=2",
        "prev": null,
        "next": "http:\/\/api.localhost\/api\/tests?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 2,
        "path": "http:\/\/api.localhost\/api\/tests",
        "per_page": 15,
        "to": 15,
        "total": 20
    }
}
```

### HTTP Request
`GET api/tests`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `page` |  optional  | For pagination

<!-- END_0146dc46bd47800ad95c740ae782432c -->

<!-- START_ef2d10a793d7091663482695b97164cc -->
## Create a new vote associated with a token

> Example request:

```bash
curl -X POST \
    "https://api.localhost/api/tests/1/votes" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"token":"expedita"}'

```

```javascript
const url = new URL(
    "https://api.localhost/api/tests/1/votes"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "token": "expedita"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/tests/{slug}/votes`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `token` | string |  required  | the external id of the user
    
<!-- END_ef2d10a793d7091663482695b97164cc -->

<!-- START_8aa201f9ac92301c2536c0cb666cbf0e -->
## Add a new external user token

> Example request:

```bash
curl -X POST \
    "https://api.localhost/api/tokens" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"token":"error"}'

```

```javascript
const url = new URL(
    "https://api.localhost/api/tokens"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "token": "error"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/tokens`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `token` | string |  required  | the external id of the user
    
<!-- END_8aa201f9ac92301c2536c0cb666cbf0e -->


