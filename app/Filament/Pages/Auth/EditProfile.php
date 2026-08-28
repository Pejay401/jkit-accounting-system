<?php

namespace App\Filament\Pages\Auth;


use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\FileUpload;
use Filament\Actions\Action;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

class EditProfile extends BaseEditProfile
{
    protected string $view = 'filament.pages.auth.edit-profile';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
               Section::make('Profile Photo')
    ->description('Update your administrator profile picture.')
    ->schema([
        Grid::make(2)
            ->schema([
                Group::make([
                    FileUpload::make('avatar_url')
                        ->label('Profile Picture')
                        ->image()
                        ->avatar()
                        ->disk('public')
                        ->directory('avatars')
                        ->visibility('public')
                        ->maxSize(2048)
                        ->getUploadedFileUsing(function (FileUpload $component, string $file, string | array | null $storedFileNames): ?array {
                            $uploadedFile = $component->getUploadedFile($file, $storedFileNames);

                            if ($uploadedFile !== null) {
                                $uploadedFile['url'] = url('storage/' . ltrim($file, '/'));
                            }

                            return $uploadedFile;
                        })
                        ->deleteUploadedFileUsing(fn (string $file): bool => Storage::disk('public')->delete($file)),

                    Actions::make([
                        Action::make('remove_profile_photo')
                            ->label('Remove profile photo')
                            ->icon('heroicon-o-trash')
                            ->color('danger')
                            ->requiresConfirmation()
                            ->visible(fn (Get $get): bool => filled($get('avatar_url')))
                            ->action(function (Get $get, Set $set): void {
                                $avatar = $get('avatar_url');

                                if (is_string($avatar) && filled($avatar)) {
                                    Storage::disk('public')->delete($avatar);
                                }

                                $set('avatar_url', null);
                            }),
                    ]),
                ])->columnSpan(1),
            ]),
    ]),

                Section::make('Personal Information')
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                    ])
                    ->columns(2),

                Section::make('Security')
                    ->schema([
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                        $this->getCurrentPasswordFormComponent(),
                    ])
                    ->columns(2),
            ]);
    }
}