<?php

namespace TechArena\Funcionalities\AWS\Repository;

use Aws\Credentials\Credentials;
use Aws\S3\S3Client;
use Symfony\Component\Mime\MimeTypes;
use TechArena\Funcionalities\AWS\Interfaces\AWSInterface;
use Exception;

class AWSRepository implements AWSInterface
{
    protected $s3Client;
    protected $bucketName;

    public function __construct()
    {
        $credentials = new Credentials(env('AWS_ACCESS_KEY_ID'), env('AWS_SECRET_ACCESS_KEY'));

        $this->s3Client = new S3Client([
            'version' => 'latest',
            'region' => env('AWS_DEFAULT_REGION'),
            'credentials' => $credentials,
            'http' => ['verify' => false],
        ]);

        $this->bucketName = env('AWS_BUCKET_NAME');
    }

    public function getImage(string $folder, string $name)
    {
    }

    public function insertImage(string $folder, string $name, $imageData): string|null
    {
        try {
            // Decodificar a imagem
            $binaryData = base64_decode($imageData);
            if (!$binaryData) {
                throw new Exception('Base64 decode failed');
            }

            // Identificar o tipo de mídia
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->buffer($binaryData);
            if (!$mimeType) {
                throw new Exception('Cannot determine MIME type');
            }

            // Gerar um nome de arquivo único baseado no tipo de arquivo
            $extension = MimeTypes::getDefault()->getExtensions($mimeType)[0] ?? '';
            $fileName = $name . ($extension ? ".{$extension}" : '');
            $filePath = $folder . '/' . $fileName;

            // Fazendo o upload do arquivo para o S3
            $result = $this->s3Client->putObject([
                'Bucket' => $this->bucketName,
                'Key' => $filePath,
                'Body' => $binaryData,
                'ContentType' => $mimeType,
            ]);

            // Obter a URL pública do arquivo (se o bucket estiver configurado para acesso público)
            return $result->get('ObjectURL');

        } catch (Exception $e) {
            return null; // Repassar a exceção ou tratar conforme necessário
        }
    }

    public function editImage(string $folder, string|null $oldName, string $newName, $imageData): string|null
    {
        try {
            // Primeiro, tentar excluir a imagem antiga se ela existir
            if ($oldName) {
                $oldFilePath = $folder . '/' . $oldName;
                $this->s3Client->deleteObject([
                    'Bucket' => $this->bucketName,
                    'Key' => $oldFilePath,
                ]);
            }

            // Agora, fazer o upload da nova imagem
            // Decodificar a imagem
            $binaryData = base64_decode($imageData);
            if (!$binaryData) {
                throw new Exception('Base64 decode failed');
            }

            // Identificar o tipo de mídia
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->buffer($binaryData);
            if (!$mimeType) {
                throw new Exception('Cannot determine MIME type');
            }

            // Gerar um nome de arquivo único baseado no tipo de arquivo
            $extension = MimeTypes::getDefault()->getExtensions($mimeType)[0] ?? '';
            $fileName = $newName . ($extension ? ".{$extension}" : '');
            $newFilePath = $folder . '/' . $fileName;

            // Fazendo o upload do arquivo para o S3
            $result = $this->s3Client->putObject([
                'Bucket' => $this->bucketName,
                'Key' => $newFilePath,
                'Body' => $binaryData,
                'ContentType' => $mimeType,
            ]);

            // Obter a URL pública do arquivo (se o bucket estiver configurado para acesso público)
            return $result->get('ObjectURL');

        } catch (Exception $e) {
            return null; // Repassar a exceção ou tratar conforme necessário
        }
    }

}
