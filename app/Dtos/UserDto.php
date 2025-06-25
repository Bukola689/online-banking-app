<?php

namespace App\Interfaces;
use App\Interfaces\DtoInterface;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserDto implements DtoInterface
{
    private int $id;

    private string $name;

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

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
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

   public static function fromApiFormRequest(UserRequest $request): DtoInterface    
   {
       $userDto = new UserDto();
        $userDto->setId($request->input('id'));
      $userDto->setName($request->input('name'));
      $userDto->setEmail($request->input('email'));
      $userDto->setPhoneNumber($request->input('phone_number'));
      $userDto->setPin($request->input('pin'));
      $userDto->setPassword($request->input('password'));
      return $userDto;
   }

   public static function fromModel(Model $model): self
   {
       $userDto = new UserDto();
       $userDto->setId($model->id);
       $userDto->setName($model->name);
       $userDto->setEmail($model->email);
       $userDto->setPhoneNumber($model->phone_number);
       $userDto->setPin($model->pin);
       $userDto->setPassword($model->password);
       $userDto0>setCreated_at($model->created_at);
       $userDto->setUpdated_at($model->updated_at);
       return $userDto;
   }

   private static function toArray(Model $model): array
   {
       return [
           'id' => $model->id,
           'email' => $model->email,
           'phone_number' => $model->phone_number,
           'pin' => $model->pin,
           'password' => $model->password,
           'created_at' => $model->created_at->toIso8601String(),
           'updated_at' => $model->updated_at->toIso8601String(),
       ];
   }
}