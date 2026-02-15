import google.generativeai as genai
with open("version_info.txt", "w") as f:
    f.write(f"Version: {genai.__version__}\n")
    f.write(f"Attributes: {dir(genai)}\n")
    try:
        f.write(f"ImageGenerationModel: {genai.ImageGenerationModel}\n")
    except AttributeError:
        f.write("ImageGenerationModel not found in genai\n")
