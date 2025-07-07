*** API DE ROBÔS ***
*** Este projeto tem apenas por finalidade de aprendizado. ***

Rota(Mostra todas as rotas - GET): /all-routes

``` 
{
    "status": "success",
    "message": "Bem-vindo à API de Robôs!",
    "description": "Esta API permite gerenciar robôs de forma simples e eficiente.",
    "routes": [
        {
            "method": "GET",
            "path": "/all-robots",
            "description": "Mostra todos os robôs."
        },
        {
            "method": "POST",
            "path": "/robots/create",
            "description": "Cria um novo robô."
        },
        {
            "method": "GET",
            "path": "/robots/{id}",
            "description": "Obtém detalhes de um robô específico."
        },
        {
            "method": "PUT",
            "path": "/robots/{id}",
            "description": "Atualiza um robô existente."
        },
        {
            "method": "DELETE",
            "path": "/robots/{id}",
            "description": "Remove um robô."
        }
    ]
}
```

Rota(Mostra todos os robôs - GET): /all-robots 

```
{
    "status": "success",
    "message": "Lista de todos os robôs.",
    "data": [
        {
            "id": 1,
            "name": "RoboMax",
            "model": "RX-100",
            "year": "2023",
            "color": "Red",
            "serialNumber": "SN0001",
            "isOn": false,
            "batteryLevel": 100
        },
        {
            "id": 2,
            "name": "CyberBot",
            "model": "ZK-50",
            "year": "2024",
            "color": "Blue",
            "serialNumber": "SN0002",
            "isOn": false,
            "batteryLevel": 100
        },
        {
            "id": 3,
            "name": "AutoDroid",
            "model": "AD-200",
            "year": "2022",
            "color": "Silver",
            "serialNumber": "SN0003",
            "isOn": false,
            "batteryLevel": 100
        },
        {
            "id": 4,
            "name": "MechaOne",
            "model": "MX-300",
            "year": "2025",
            "color": "Black",
            "serialNumber": "SN0004",
            "isOn": false,
            "batteryLevel": 100
        },
        {
            "id": 5,
            "name": "NanoRobo",
            "model": "NR-20",
            "year": "2023",
            "color": "White",
            "serialNumber": "SN0005",
            "isOn": false,
            "batteryLevel": 100
        },
        {
            "id": 6,
            "name": "SteelCore",
            "model": "SC-77",
            "year": "2024",
            "color": "Gray",
            "serialNumber": "SN0006",
            "isOn": false,
            "batteryLevel": 100
        },
        {
            "id": 7,
            "name": "VoltX",
            "model": "VX-10",
            "year": "2021",
            "color": "Green",
            "serialNumber": "SN0007",
            "isOn": false,
            "batteryLevel": 100
        },
        {
            "id": 8,
            "name": "SkyDroid",
            "model": "SD-8",
            "year": "2022",
            "color": "Blue",
            "serialNumber": "SN0008",
            "isOn": false,
            "batteryLevel": 100
        },
        {
            "id": 9,
            "name": "IronPulse",
            "model": "IP-404",
            "year": "2025",
            "color": "Orange",
            "serialNumber": "SN0009",
            "isOn": false,
            "batteryLevel": 100
        },
        {
            "id": 10,
            "name": "HydraBot",
            "model": "HB-1",
            "year": "2020",
            "color": "Purple",
            "serialNumber": "SN0010",
            "isOn": false,
            "batteryLevel": 100
        },
        {
            "id": 11,
            "name": "TechnoMech",
            "model": "TM-909",
            "year": "2023",
            "color": "Cyan",
            "serialNumber": "SN0011",
            "isOn": false,
            "batteryLevel": 100
        },
        {
            "id": 12,
            "name": "NeuroDroid",
            "model": "ND-12",
            "year": "2024",
            "color": "Silver",
            "serialNumber": "SN0012",
            "isOn": false,
            "batteryLevel": 100
        },
        {
            "id": 13,
            "name": "FusionBot",
            "model": "FB-89",
            "year": "2021",
            "color": "Yellow",
            "serialNumber": "SN0013",
            "isOn": false,
            "batteryLevel": 100
        },
        {
            "id": 14,
            "name": "QuantumBot",
            "model": "QB-99",
            "year": "2022",
            "color": "Black",
            "serialNumber": "SN0014",
            "isOn": false,
            "batteryLevel": 100
        },
        {
            "id": 15,
            "name": "LogicBot",
            "model": "LB-7",
            "year": "2020",
            "color": "White",
            "serialNumber": "SN0015",
            "isOn": false,
            "batteryLevel": 100
        },
        {
            "id": 16,
            "name": "MegaCore",
            "model": "MC-1",
            "year": "2024",
            "color": "Red",
            "serialNumber": "SN0016",
            "isOn": false,
            "batteryLevel": 100
        },
        {
            "id": 17,
            "name": "ZetaBot",
            "model": "ZB-202",
            "year": "2023",
            "color": "Blue",
            "serialNumber": "SN0017",
            "isOn": false,
            "batteryLevel": 100
        },
        {
            "id": 18,
            "name": "GammaDroid",
            "model": "GD-30",
            "year": "2025",
            "color": "Green",
            "serialNumber": "SN0018",
            "isOn": false,
            "batteryLevel": 100
        },
        {
            "id": 19,
            "name": "XenoRobo",
            "model": "XR-18",
            "year": "2021",
            "color": "Gray",
            "serialNumber": "SN0019",
            "isOn": false,
            "batteryLevel": 100
        },
        {
            "id": 20,
            "name": "NovaBot",
            "model": "NB-5",
            "year": "2023",
            "color": "Pink",
            "serialNumber": "SN0020",
            "isOn": false,
            "batteryLevel": 100
        }
    ]
}
```

Rota(Cria um robô - POST): robots/create

```
{
    "id": 22,
    "name": "ROBOTho",
    "model": "SN0069",
    "year": "2001",
    "color": "PINK",
    "serialNumber": "SKO0009992",
    "isOn": false,
    "batteryLevel": 100
}
{
    "status": "success",
    "message": "Robô atualizado com sucesso."
}
```

Rota(Seleciona um robô - GET): /robots/id

```
{
    "status": "success",
    "message": "Detalhes do robô.",
    "data": {
        "id": 14,
        "name": "QuantumBot",
        "model": "QB-99",
        "year": "2022",
        "color": "Black",
        "serialNumber": "SN0014",
        "isOn": false,
        "batteryLevel": 100
    }
}
```

Rota(Atualiza um robô - PUT): robots/id

```
{
    "id": 22,
    "name": "ROBOTho",
    "model": "SN0069",
    "year": "2001",
    "color": "PINK",
    "serialNumber": "SKO0009992",
    "isOn": false,
    "batteryLevel": 100
}
{
    "status": "success",
    "message": "Robô atualizado com sucesso."
}
```

Rota(Deleta um robô - DELETE) : /robots/id

```
{
    "status": "success",
    "message": "Robô removido com sucesso."
}
```