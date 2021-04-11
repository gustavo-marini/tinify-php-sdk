<?php

    namespace Secco2112\Tinify;

    class Options {

        const TINIFYOPT_API_KEY = 'api_key';
        const TINIFYOPT_BASE_URL = 'https://api.tinify.com';

        const TINIFYOPT_RESIZE_METHOD = 'method';
        const TINIFYOPT_RESIZE_WIDTH = 'width';
        const TINIFYOPT_RESIZE_HEIGHT = 'height';

        const TINIFYOPT_RESIZE_SCALE = 'scale';
        const TINIFYOPT_RESIZE_FIT = 'fit';
        const TINIFYOPT_RESIZE_COVER = 'cover';
        const TINIFYOPT_RESIZE_THUMB = 'thumb';

        const TINIFYOPT_STORE_SERVICE_S3 = 's3';
        const TINIFYOPT_STORE_SERVICE_GCS = 'gcs';

        const TINIFYOPT_STORE_OPTION_AWS_ACCESS_KEY_ID = 'aws_access_key_id';
        const TINIFYOPT_STORE_OPTION_AWS_SECRET_ACCESS_KEY = 'aws_secret_access_key';
        const TINIFYOPT_STORE_OPTION_AWS_REGION = 'region';
        
        const TINIFYOPT_STORE_OPTION_GCP_ACCESS_TOKEN = 'gcp_access_token';

        const TINIFYOPT_STORE_OPTION_HEADERS = 'headers';
        const TINIFYOPT_STORE_OPTION_PATH = 'path';

    }