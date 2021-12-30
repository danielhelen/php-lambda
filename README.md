# PHP Lambda

A simple example of an AWS Lambda function that uses a custom runtime provided by [Bref](https://bref.sh/) to execute
code written in PHP.

## Rationale

Bref makes it really easy to deploy and run (lower-case "s") serverless PHP applications, but it relies heavily on the
(upper-case "S") [Serverless Framework](https://www.serverless.com/).

The Serverless Framework is great, but it is not always an option in organisations that use different (often bespoke)
deployment tools. It also creates a layer of abstraction that hides a lot of details that it would be useful for a
developer to understand about AWS.

This repo demonstrates how to use the PHP runtimes published as Lambda layers by Bref with CloudFormation templates to
deploy the AWS resources.

## Deployment

The AWS resources are defined in the two CloudFormation stacks in the `infrastructure` directory.

The source code for the function itself first needs to be compressed. There is a Makefile in the root of this repo that 
will prepare the code for production and output a `package.zip` file. Simply run `make build`.

Before creating the CloudFormation stacks in the AWS console, the `package.zip` file needs to be uploaded to an S3 
bucket. This is because the Lambda function needs some code when it is first created. For future releases of the source 
code, run `make build` again and upload the zip file via the Lambda console. 

Use the CloudFormation console to create the Lambda function using the `lambda.json` file. You will need to 
specify the bucket name and object key of the compressed source code in S3. You can also change the custom runtime layer
that it uses but a default is provided. Take a look at the list of available 
[Bref runtimes](https://runtimes.bref.sh/). They provide runtimes for different versions of PHP and ones suitable for 
different situations such as serving web requests or running simple functions.

Finally, create the API endpoint that will invoke your PHP Lambda function by uploading the `api-gateway.json` stack 
into the CloudFormation console. You will need to specify the name of the stack that created the Lambda function. The 
invoke URL is available as the `InvokeURL` stack output. 
