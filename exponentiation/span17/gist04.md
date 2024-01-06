[![2022-12-26 (4)](https://user-images.githubusercontent.com/8466209/209532746-5a09e0f6-9346-4d61-aee8-eeef1f801e5a.png)
](https://console.cloud.google.com/iam-admin/serviceaccounts/create?authuser=1&project=marketleader&cloudshell=false)

[![2022-12-26 (6)](https://user-images.githubusercontent.com/8466209/209535961-5441181b-a87b-4879-8e6a-c752eaaec587.png)
](https://console.cloud.google.com/iam-admin/serviceaccounts/details/112927040009179159531/permissions?authuser=1&project=marketleader)

[gcloud](https://developers.google.com/cloud/sdk/gcloud/reference/compute/?hl=en_US) command line

```
gcloud compute instance-templates create instance-template-ubuntu-01 \
--project=marketleader --machine-type=e2-micro --network-interface=network=default,network-tier=PREMIUM \
--maintenance-policy=MIGRATE --provisioning-model=STANDARD \
--service-account=project-owner@marketleader.iam.gserviceaccount.com \
--scopes=https://www.googleapis.com/auth/source.full_control,\
https://www.googleapis.com/auth/compute,https://www.googleapis.com/auth/servicecontrol,\
https://www.googleapis.com/auth/service.management.readonly,\
https://www.googleapis.com/auth/logging.write,https://www.googleapis.com/auth/monitoring.write,\
https://www.googleapis.com/auth/trace.append,https://www.googleapis.com/auth/devstorage.read_only \
--create-disk=auto-delete=yes,boot=yes,device-name=instance-template-ubuntu-2204LTS,\
image=projects/ubuntu-os-cloud/global/images/ubuntu-2204-jammy-v20221206,mode=rw,size=10,type=pd-standard \
--no-shielded-secure-boot --shielded-vtpm --shielded-integrity-monitoring --reservation-affinity=any \
--tags=https-server --threads-per-core=2
```

Equivalent [REST request](https://developers.google.com/compute/docs/reference/latest?hl=en_US)

```
POST https://www.googleapis.com/compute/v1/projects/marketleader/global/instanceTemplates
{
  "description": "",
  "name": "instance-template-ubuntu-01",
  "properties": {
    "advancedMachineFeatures": {
      "threadsPerCore": 2
    },
    "canIpForward": false,
    "confidentialInstanceConfig": {
      "enableConfidentialCompute": false
    },
    "description": "",
    "disks": [
      {
        "autoDelete": true,
        "boot": true,
        "deviceName": "instance-template-ubuntu-2204LTS",
        "diskEncryptionKey": {},
        "initializeParams": {
          "diskSizeGb": "10",
          "diskType": "pd-standard",
          "labels": {},
          "sourceImage": "projects/ubuntu-os-cloud/global/images/ubuntu-2204-jammy-v20221206"
        },
        "mode": "READ_WRITE",
        "type": "PERSISTENT"
      }
    ],
    "displayDevice": {
      "enableDisplay": false
    },
    "keyRevocationActionType": "NONE",
    "labels": {},
    "machineType": "e2-micro",
    "metadata": {
      "items": []
    },
    "networkInterfaces": [
      {
        "accessConfigs": [
          {
            "kind": "compute#accessConfig",
            "name": "External NAT",
            "networkTier": "PREMIUM",
            "type": "ONE_TO_ONE_NAT"
          }
        ],
        "network": "projects/marketleader/global/networks/default",
        "stackType": "IPV4_ONLY"
      }
    ],
    "reservationAffinity": {
      "consumeReservationType": "ANY_RESERVATION"
    },
    "scheduling": {
      "automaticRestart": true,
      "onHostMaintenance": "MIGRATE",
      "provisioningModel": "STANDARD"
    },
    "serviceAccounts": [
      {
        "email": "project-owner@marketleader.iam.gserviceaccount.com",
        "scopes": [
          "https://www.googleapis.com/auth/source.full_control",
          "https://www.googleapis.com/auth/compute",
          "https://www.googleapis.com/auth/servicecontrol",
          "https://www.googleapis.com/auth/service.management.readonly",
          "https://www.googleapis.com/auth/logging.write",
          "https://www.googleapis.com/auth/monitoring.write",
          "https://www.googleapis.com/auth/trace.append",
          "https://www.googleapis.com/auth/devstorage.read_only"
        ]
      }
    ],
    "shieldedInstanceConfig": {
      "enableIntegrityMonitoring": true,
      "enableSecureBoot": false,
      "enableVtpm": true
    },
    "tags": {
      "items": [
        "https-server"
      ]
    }
  }
}
```

[![instance-template-ubuntu-2204LTS](https://user-images.githubusercontent.com/8466209/209422018-1209129c-fc1d-4d21-baf9-3d8791c65bcb.png)
](https://console.cloud.google.com/compute/instanceTemplates/add?authuser=1&cloudshell=false&project=marketleader)

[![2022-12-24 (9)](https://user-images.githubusercontent.com/8466209/209423099-b1a94680-016a-4a05-a8d0-a8bed34ea099.png)
](https://console.cloud.google.com/compute/instanceTemplates/add?authuser=1&cloudshell=false&project=marketleader)

![Untitled](https://user-images.githubusercontent.com/8466209/253502287-3490508a-c791-42f0-91b4-6518f6f9d384.png)
