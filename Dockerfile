# Use a Node.js 16 base image
FROM node:16-alpine

# Set the working directory to /app
WORKDIR /app

# Copy the package.json and package-lock.json files to the container
COPY ./frontend/package*.json ./

# Install the dependencies
RUN npm install

# Copy the rest of the application code to the container
COPY ./frontend .

# Build the Next.js app for production
#RUN npm run build

# Expose port 3000
EXPOSE 3000

# Start the Next.js app
CMD ["npm", "run", "dev"]
