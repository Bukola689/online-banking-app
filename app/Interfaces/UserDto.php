<?php

namespace App\Interfaces;
use App\Interfaces\DtoInterface;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserDto implements DtoInterface
{
    private int $id;

    private string $email;

    private string $phone_number;

    private string $pin;
    /**
     * @var string
     */
    
    private string $password;

    private Carbon $created_at;

    private Carbon $updated_at;

   public function setId(int $id): self
   {
       $this->id = $id;
       return $this;
   }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    public function getPin(): string
    {
        return $this->pin;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->updated_at;
    }

   public static function fromApiFormRequest(): self
   {
       // Implementation for creating a UserDto from an API form request
       // This would typically involve validating and transforming the incoming data
   }

   public static function fromModel(Model $model): self
   {
    //    $dto = new self();
    //    $dto->id = $model->id;
    //    $dto->email = $model->email;
    //    $dto->phone_number = $model->phone_number;
    //    $dto->pin = $model->pin;
    //    $dto->password = $model->password;
    //    $dto->created_at = $model->created_at;
    //    $dto->updated_at = $model->updated_at;

    //    return $dto;
   }

   private static function toArray(Model $model): array
   {
    //    return [
    //        'id' => $model->id,
    //        'email' => $model->email,
    //        'phone_number' => $model->phone_number,
    //        'pin' => $model->pin,
    //        'password' => $model->password,
    //        'created_at' => $model->created_at->toIso8601String(),
    //        'updated_at' => $model->updated_at->toIso8601String(),
    //    ];
   }
}