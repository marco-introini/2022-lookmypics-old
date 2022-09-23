<?php

namespace App\Filament\Resources\AlbumResource\RelationManagers;

use App\Enums\AcceptanceStatus;
use App\Jobs\MultiUploadAlbumJob;
use App\Models\Album;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->maxLength(2000),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->required()
                    ->disk('public')
                    ->directory('images')
                    ->maxSize(5000)
                    ->storeFileNamesIn('image_file_name'),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\BadgeColumn::make('accepted')
                    ->colors([
                        'danger' => static fn($state): bool => $state === AcceptanceStatus::REJECTED->value,
                        'secondary' => static fn($state): bool => $state === AcceptanceStatus::NOT_DEFINED->value,
                        'success' => static fn($state): bool => $state === AcceptanceStatus::ACCEPTED->value,
                    ]),
            ])
            ->filters([
                Filter::make('not_defined')
                    ->query(
                        fn(Builder $query): Builder => $query->where(
                            'accepted',
                            'like',
                            AcceptanceStatus::NOT_DEFINED->value
                        )
                    )
                    ->label('To Be Defined')
                    ->toggle(),
                Filter::make('accepted')
                    ->query(
                        fn(Builder $query): Builder => $query->where(
                            'accepted',
                            'like',
                            AcceptanceStatus::ACCEPTED->value
                        )
                    )
                    ->label('Accepted')
                    ->toggle(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\Action::make('multi_upload')
                    ->label('Multi Upload')
                    ->button()
                    ->requiresConfirmation()
                    ->modalHeading('Multi Upload')
                    ->modalSubheading('This will add any image in /upload into this album.')
                    ->modalButton('Yes, add them')
                    ->action(function ($livewire) {
                        MultiUploadAlbumJob::dispatch($livewire->ownerRecord);
                    })
                //->modalContent(fn ($livewire): string => route('albums.import',['album' => $livewire->ownerRecord]))
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
